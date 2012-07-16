package com.yss.handlers;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;

import com.yss.controller.AppConstant;
import com.yss.controller.AppController;
import com.yss.dao.ClienteDAO;
import com.yss.dao.ProductoDAO;
import com.yss.dao.StockProfitDAO;
import com.yss.dto.ClienteDTO;
import com.yss.dto.ErrorMessageDTO;
import com.yss.dto.ListPageResultDTO;
import com.yss.dto.LoginDTO;
import com.yss.dto.ProductoDTO;
import com.yss.dto.ShopCarDTO;
import com.yss.properties.MessagesProperties;

/**
 * 
 * Class: ShopCarHandler
 * Creation Date: 05/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public class ShopCarHandler {
	private static final Logger logger = Logger.getLogger(ShopCarHandler.class);
	
	/**
	 * Mostramos la pagina inicial para crear el carrito de compra.
	 * Si es vendedor debe seleccionar el cliente, si es cliente debe seleccionar sus productos.
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void createShopCar(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		//vemos si el usuario es vendedor o cliente
		//ya que el paso inicial va a ser distinto en ambos casos
		
		ErrorMessageDTO erroresDTO = new ErrorMessageDTO();
		LoginDTO loginDTO = (LoginDTO) request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW);
		
		if(loginDTO == null){
			//no hay sesion previa
			//debemos ir al inicio
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue("mustStartSession"));
			logger.error("No hay session previa en el sistema, llevamos al usuario a la pagina de login");
			controller.forward(erroresDTO, request, response, "/webpages/loginForm.jsp");
			return;
		}
		
		//verificamos si el usuario es cliente o vendedor
		if(AppConstant.ROL_VENDEDOR_VALUE == loginDTO.getIdRol()){
			//este usuario es vendedor, lo dirigimos a la pagina donde debe indicar los clientes
			//y eliminamos de sesion cualquier carrito previo
			request.getSession().removeAttribute(AppConstant.ATT_SHOP_CAR_DTO);
			controller.forward(null, request, response, "/webpages/ordenCompra/compraVendedorPaso1.jsp");
			return;
		} else if(AppConstant.ROL_CLIENTE_VALUE == loginDTO.getIdRol()){
			//este usuario es cliente, lo dirigimos a la pagina donde debe indicar los productos
			selectProductsToCar(request, response, controller);
		} else {
			//el rol de este usuario no le da acceso a esta funcionalidad
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue("operationNotAllowed"));
			controller.forward(erroresDTO, request, response, "/webpages/onlyInfo.jsp");
			return;
		}
	}
	
	/**
	 * Metodo usado para obtener los registros de determinada pagina del listado de clientes
	 * en base a los criterios enviados.
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void getClientPageByAjax(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		//obtenemos el numero de pagina a obtener
		int pageNumber = Integer.parseInt(request.getParameter(AppConstant.PAGING_PAGE_NUMBER));
		//obtenemos los criterios de busqueda
		String rifToSearch = request.getParameter(AppConstant.PARAM_RIF_CLIENTE);
		String nameToSearch = request.getParameter(AppConstant.PARAM_RAZON_SOCIAL_CLIENTE);
		String contactToSearch = request.getParameter(AppConstant.PARAM_CONTACTO_CLIENTE);
		
		ListPageResultDTO<ClienteDTO> results = ClienteDAO.getClientListByCriteria(pageNumber, rifToSearch, 
				nameToSearch, contactToSearch);
		
		//se obtuvo un resultado valido
		request.setAttribute(AppConstant.PARAM_RIF_CLIENTE, rifToSearch);
		request.setAttribute(AppConstant.PARAM_RAZON_SOCIAL_CLIENTE, nameToSearch);
		request.setAttribute(AppConstant.PARAM_CONTACTO_CLIENTE, contactToSearch);
		request.setAttribute(AppConstant.ATT_PAGING_RESULTS, results);
		
		controller.forward(null, request, response, "/webpages/ajaxResults/clientsPaging.jsp");
	}
	
	/**
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void selectProductsToCar(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		final String method = "selectProductsToCar(): ";
		ErrorMessageDTO erroresDTO = new ErrorMessageDTO();
		LoginDTO loginDTO = (LoginDTO) request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW);
		ClienteDTO cliente = null;
		String vendedor = "WEB";
		
		if(loginDTO == null){
			//no hay sesion previa
			//debemos ir al inicio
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue("mustStartSession"));
			logger.error("No hay session previa en el sistema, llevamos al usuario a la pagina de login");
			controller.forward(erroresDTO, request, response, "/webpages/loginForm.jsp");
			return;
		}
		
		cliente = (ClienteDTO) request.getSession().getAttribute(AppConstant.ATT_CLIENTE_DTO);
		if((AppConstant.ROL_CLIENTE_VALUE == loginDTO.getIdRol()) && (cliente == null)){
			//no tengo cliente en sesion, intento cargarlo.
			cliente = ClienteDAO.getClienteById(loginDTO.getIdClienteRelated());
		}else if((AppConstant.ROL_VENDEDOR_VALUE == loginDTO.getIdRol()) && (cliente == null)){
			//no tengo cliente en sesion, intento cargarlo.
			vendedor = loginDTO.getIdUsuario();
			cliente = ClienteDAO.getClienteById(request.getParameter(AppConstant.PARAM_ID_CLIENTE));
		}
		
		if(cliente == null){
			//el cliente sigue siendo null, debo indicar error y no continuar
			String pageToforward = "/webpages/welcome.jsp";
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue("notClientInSession"));
			
			if(AppConstant.ROL_VENDEDOR_VALUE == loginDTO.getIdRol()){
				pageToforward = "/webpages/ordenCompra/compraVendedorPaso1.jsp";
			}
			
			logger.info(method + "No se encontro informacion del cliente, redirigimos a -> " + pageToforward);
			controller.forward(erroresDTO, request, response, pageToforward);
			return;
		} else if (cliente.getPrecioA() == null){
			//el cliente existe, pero no tiene precio configurado.
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue("clientDoesntHaveAPrice"));
			controller.forward(erroresDTO, request, response, "/webpages/onlyInfo.jsp");
			return;
		}
		
		if(AppConstant.ROL_CLIENTE_VALUE == loginDTO.getIdRol()){
			//vemos si ya hemos cargado en sesion la informacion de este cliente
			request.getSession().setAttribute(AppConstant.ATT_CLIENTE_DTO, cliente);
		}
		
		if(request.getSession().getAttribute(AppConstant.ATT_SHOP_CAR_DTO) == null){
			ShopCarDTO shopCar = new ShopCarDTO();
			shopCar.setCliente(cliente);
			shopCar.setNombreVendedor(vendedor);
			
			request.getSession().setAttribute(AppConstant.ATT_SHOP_CAR_DTO, shopCar);
		}
		
		request.setAttribute(AppConstant.ATT_CLIENTE_DTO, cliente);
		request.setAttribute(AppConstant.ATT_SHOP_CAR_DTO, 
				request.getSession().getAttribute(AppConstant.ATT_SHOP_CAR_DTO));
		
		controller.forward(erroresDTO, request, response, "/webpages/ordenCompra/shopOrderProductList.jsp");
	}
	
	/**
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void getProductsPageByAjax(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		int pageNumber = Integer.parseInt(request.getParameter(AppConstant.PAGING_PAGE_NUMBER));
		
		//obtenemos los criterios de busqueda
		String idProductToSearch = request.getParameter(AppConstant.PARAM_ID_PRODUCTO);
		String descProductToSearch = request.getParameter(AppConstant.PARAM_DESC_PRODUCTO);
		String lineaProductToSearch = request.getParameter(AppConstant.PARAM_LINEA_PRODUCTO);
		String marcaProductToSearch = request.getParameter(AppConstant.PARAM_MARCA_PRODUCTO);
		
		ListPageResultDTO<ProductoDTO> results = ProductoDAO.getProductListByCriteria(pageNumber, 
				idProductToSearch, 
				lineaProductToSearch, 
				marcaProductToSearch, 
				descProductToSearch);
		
		request.setAttribute(AppConstant.PARAM_ID_PRODUCTO, idProductToSearch);
		request.setAttribute(AppConstant.PARAM_DESC_PRODUCTO, descProductToSearch);
		request.setAttribute(AppConstant.PARAM_LINEA_PRODUCTO, lineaProductToSearch);
		request.setAttribute(AppConstant.PARAM_MARCA_PRODUCTO, marcaProductToSearch);
		request.setAttribute(AppConstant.ATT_PAGING_RESULTS, results);
		
		controller.forward(null, request, response, "/webpages/ajaxResults/productsPaging.jsp");
	}
	
	/**
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void addProductToShopCar(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		//obtenemos el id de producto
		final String idProducto = request.getParameter(AppConstant.PARAM_ID_PRODUCTO);
		final String method = "addProductToShopCar(): ";
		
		ErrorMessageDTO erroresDTO = new ErrorMessageDTO();
		LoginDTO loginDTO = (LoginDTO) request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW);
		ShopCarDTO shopCar = (ShopCarDTO) request.getSession().getAttribute(AppConstant.ATT_SHOP_CAR_DTO);
		ProductoDTO producto = null;
		
		if(loginDTO == null){
			//no hay sesion previa
			//debemos ir al inicio
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue("mustStartSession"));
			logger.error("No hay session previa en el sistema, llevamos al usuario a la pagina de login");
			controller.forward(erroresDTO, request, response, "/webpages/loginForm.jsp");
			return;
		}
		
		producto = shopCar.getProductFromCar(idProducto);
		if(producto == null){
			producto = ProductoDAO.getProductoById(idProducto);
		}
		if(producto != null){
			//intentamos convertir la cantidad recibida por parametro
			int cantidad = 1;
			try {
				cantidad = Integer.parseInt(request.getParameter(AppConstant.PARAM_CANTIDAD_PRODUCTO));
			} catch (Exception e) {
				logger.warn(method + "La cantidad indicada no es numerica, colocamos por defecto 1 unidad.");
			}
			if(StockProfitDAO.checkStockExistance(idProducto, cantidad)){
				shopCar.addProductToCar(producto, cantidad);
				logger.info(method + "Agregado con exito producto ["
						+ producto.getIdProducto() + ", " + producto.getDescripcion() + ", " + cantidad + "] al carrito");
			}else{
				shopCar.addProductToCar(producto, cantidad);
				logger.warn(method + "No hay suficiente Stock para suplir el producto ["
						+ producto.getIdProducto() + ", " + producto.getDescripcion() + ", " + cantidad + "]");
			}
			
		}
		
		request.setAttribute(AppConstant.ATT_SHOP_CAR_DTO, shopCar);
		request.getSession().setAttribute(AppConstant.ATT_SHOP_CAR_DTO, shopCar);
		
		controller.forward(erroresDTO, request, response, "/webpages/ajaxResults/afterAddProduct.jsp");
		return;
	}
	
	/**
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void viewCurrentShopCar(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		ErrorMessageDTO erroresDTO = new ErrorMessageDTO();
		LoginDTO loginDTO = (LoginDTO) request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW);
		ShopCarDTO shopCar = (ShopCarDTO) request.getSession().getAttribute(AppConstant.ATT_SHOP_CAR_DTO);
		
		if(loginDTO == null){
			//no hay sesion previa
			//debemos ir al inicio
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue("mustStartSession"));
			logger.error("No hay session previa en el sistema, llevamos al usuario a la pagina de login");
			controller.forward(erroresDTO, request, response, "/webpages/loginForm.jsp");
			return;
		}
		
		request.setAttribute(AppConstant.ATT_SHOP_CAR_DTO, shopCar);
		
		controller.forward(erroresDTO, request, response, "/webpages/ordenCompra/viewCurrentOrder.jsp");
		return;
	}
}
