package com.yss.handlers;

import java.text.MessageFormat;

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
import com.yss.properties.MessagesProperties.MsgPropertyNames;

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
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_mustStartSession));
			logger.error("No hay session previa en el sistema, llevamos al usuario a la pagina de login");
			controller.forward(erroresDTO, request, response, "/webpages/loginForm.jsp");
			return;
		}
		
		//verificamos si el usuario es cliente o vendedor
		if(AppConstant.ROL_VENDEDOR_VALUE == loginDTO.getIdRol()){
			//este usuario es vendedor, 
			//si no existe un carrito previo lo dirigimos a la pagina donde debe indicar los clientes
			//si existe carrito previo lo llevamos a la pagina de productos
			if(request.getSession().getAttribute(AppConstant.ATT_SHOP_CAR_DTO) == null){
				controller.forward(null, request, response, "/webpages/ordenCompra/compraVendedorPaso1.jsp");
			}else{
				selectProductsToCar(request, response, controller);
			}
			
			return;
		} else if(AppConstant.ROL_CLIENTE_VALUE == loginDTO.getIdRol()){
			//este usuario es cliente, lo dirigimos a la pagina donde debe indicar los productos
			selectProductsToCar(request, response, controller);
		} else {
			//el rol de este usuario no le da acceso a esta funcionalidad
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_operationNotAllowed));
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
		ShopCarDTO shopCarDTO = (ShopCarDTO) request.getSession().getAttribute(AppConstant.ATT_SHOP_CAR_DTO);
		ClienteDTO cliente = null;
		String vendedor = "WEB";
		
		if(loginDTO == null){
			//no hay sesion previa
			//debemos ir al inicio
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_mustStartSession));
			logger.error("No hay session previa en el sistema, llevamos al usuario a la pagina de login");
			controller.forward(erroresDTO, request, response, "/webpages/loginForm.jsp");
			return;
		}
		
		cliente = (ClienteDTO) request.getSession().getAttribute(AppConstant.ATT_CLIENTE_DTO);
		if((AppConstant.ROL_CLIENTE_VALUE == loginDTO.getIdRol()) && (cliente == null)){
			//no tengo cliente en sesion, intento cargarlo.
			cliente = ClienteDAO.getClienteById(loginDTO.getIdClienteRelated());
		}else if((AppConstant.ROL_VENDEDOR_VALUE == loginDTO.getIdRol()) && (cliente == null)){
			vendedor = loginDTO.getIdUsuario();
			
			//si el vendedor tiene carrito aun en session quiere decir que ya tiene cliente
			if(shopCarDTO != null){
				//tengo cliente en el carrito que esta en sesion, intento cargarlo.
				cliente = shopCarDTO.getCliente();
			}else{
				//no tengo cliente en sesion, intento cargarlo.
				cliente = ClienteDAO.getClienteById(request.getParameter(AppConstant.PARAM_ID_CLIENTE));
			}
		}
		
		if(cliente == null){
			//el cliente sigue siendo null, debo indicar error y no continuar
			String pageToforward = "/webpages/welcome.jsp";
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_notClientInSession));
			
			if(AppConstant.ROL_VENDEDOR_VALUE == loginDTO.getIdRol()){
				pageToforward = "/webpages/ordenCompra/compraVendedorPaso1.jsp";
			}
			
			logger.info(method + "No se encontro informacion del cliente, redirigimos a -> " + pageToforward);
			controller.forward(erroresDTO, request, response, pageToforward);
			return;
		} else if (cliente.getPrecioA() == null){
			//el cliente existe, pero no tiene precio configurado.
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_clientDoesntHaveAPrice));
			controller.forward(erroresDTO, request, response, "/webpages/onlyInfo.jsp");
			return;
		}
		
		if(AppConstant.ROL_CLIENTE_VALUE == loginDTO.getIdRol()){
			//vemos si ya hemos cargado en sesion la informacion de este cliente
			request.getSession().setAttribute(AppConstant.ATT_CLIENTE_DTO, cliente);
		}
		
		if(shopCarDTO == null){
			shopCarDTO = new ShopCarDTO();
			shopCarDTO.setCliente(cliente);
			shopCarDTO.setNombreVendedor(vendedor);
			
			request.getSession().setAttribute(AppConstant.ATT_SHOP_CAR_DTO, shopCarDTO);
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
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_mustStartSession));
			logger.error("No hay session previa en el sistema, llevamos al usuario a la pagina de login");
			controller.forward(erroresDTO, request, response, "/webpages/ajaxResults/showAjaxErrors.jsp");
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
			if(StockProfitDAO.checkStockExistance(erroresDTO, idProducto, cantidad)){
				shopCar.addProductToCar(producto, cantidad);
				logger.info(method + "Agregado con exito producto ["
						+ producto.getIdProducto() + ", " + producto.getDescripcion() + ", " + cantidad + "] al carrito");
			}else{
				logger.warn(method + "No hay suficiente Stock para suplir el producto ["
						+ producto.getIdProducto() + ", " + producto.getDescripcion() + ", " + cantidad + "]");
				controller.forward(erroresDTO, request, response, "/webpages/ajaxResults/showAjaxErrors.jsp");
				return;
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
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_mustStartSession));
			logger.error("No hay session previa en el sistema, llevamos al usuario a la pagina de login");
			controller.forward(erroresDTO, request, response, "/webpages/loginForm.jsp");
			return;
		}
		
		request.setAttribute(AppConstant.ATT_SHOP_CAR_DTO, shopCar);
		
		controller.forward(erroresDTO, request, response, "/webpages/ordenCompra/viewCurrentOrder.jsp");
		return;
	}
	
	/**
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void storeShopCar(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		final String method = "storeShopCar(): ";
		ErrorMessageDTO erroresDTO = new ErrorMessageDTO();
		LoginDTO loginDTO = (LoginDTO) request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW);
		ShopCarDTO shopCar = (ShopCarDTO) request.getSession().getAttribute(AppConstant.ATT_SHOP_CAR_DTO);
		
		logger.info(request.getParameterMap());
		if(loginDTO == null){
			//no hay sesion previa
			//debemos ir al inicio
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_mustStartSession));
			logger.error(method + "No hay session previa en el sistema para esta peticion");
			controller.forward(erroresDTO, request, response, "/webpages/ajaxResults/showAjaxErrors.jsp");
			return;
		}
		
		if(shopCar == null){
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_preOrderDoesntExists));
			logger.error(method + "Este usuario no posee una orden de compra en session");
			controller.forward(erroresDTO, request, response, "/webpages/ajaxResults/showAjaxErrors.jsp");
			return;
		}
		
		//tenemos sesion y carrito, validamos nuevamente el stock
		int i = 0;
		boolean mustContinue = true;
		
		while(mustContinue){
			String codProducto = request.getParameter("idProducto_" + i);
			
			if(codProducto != null){
				//tenemos producto, revisamos la cantidad
				String cantidad = request.getParameter("cantidad_" + i);
				int cantidadRequerida = 0;
				try {
					cantidadRequerida = Integer.parseInt(cantidad);
					StockProfitDAO.checkStockExistance(erroresDTO, codProducto, cantidadRequerida);
				} catch (NumberFormatException e) {
					// TODO: handle exception
					//la cantidad para este producto no es numerica, debemos indicarlo
					erroresDTO.addErrorMessage(MessageFormat.format(
							MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_notNumericValueToProduct), codProducto));
				}
			} else {
				mustContinue = false;
			}
			
			i++;
		}
		
		if(erroresDTO.getErrorCount() == 0){
			//todo el proceso de validacion de carrito fue exitoso
			//lo almacenamos en la base de datos
			
		} else {
			controller.forward(erroresDTO, request, response, "/webpages/ajaxResults/showAjaxErrors.jsp");
			return;
		}
		
		erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_sucessfullRequest));
		request.getSession().setAttribute(AppConstant.ATT_SHOP_CAR_DTO, null);
		request.setAttribute(AppConstant.ATT_REDIRECT_TO_WELCOME, true);
		request.setAttribute(AppConstant.ATT_ERRORES_MSGS, erroresDTO);
		
		logger.error(method + "Fue procesada con exito la orden de compra que estaba en session.");
		
		controller.forward(erroresDTO, request, response, "/webpages/ajaxResults/showAjaxInfoMsgs.jsp");
		return;
	}
	
	/**
	 * 
	 * @param request
	 * @param response
	 * @param controller
	 * @throws Exception
	 */
	public static void discardShopOrder(HttpServletRequest request,
			HttpServletResponse response, AppController controller)
	throws Exception{
		final String method = "discardShopOrder(): ";
		ErrorMessageDTO erroresDTO = new ErrorMessageDTO();
		LoginDTO loginDTO = (LoginDTO) request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW);
		ShopCarDTO shopCar = (ShopCarDTO) request.getSession().getAttribute(AppConstant.ATT_SHOP_CAR_DTO);
		
		if(loginDTO == null){
			//no hay sesion previa
			//debemos ir al inicio
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_mustStartSession));
			logger.error(method + "No hay session previa en el sistema para esta peticion");
			controller.forward(erroresDTO, request, response, "/webpages/ajaxResults/showAjaxErrors.jsp");
			return;
		}
		
		if(shopCar == null){
			erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_preOrderDoesntExists));
			logger.error(method + "Este usuario no posee una orden de compra en session");
			controller.forward(erroresDTO, request, response, "/webpages/ajaxResults/showAjaxErrors.jsp");
			return;
		}
		
		erroresDTO.addErrorMessage(MessagesProperties.getPropertyValue(MsgPropertyNames.MSG_sucessfullRequest));
		request.getSession().setAttribute(AppConstant.ATT_SHOP_CAR_DTO, null);
		request.setAttribute(AppConstant.ATT_REDIRECT_TO_WELCOME, true);
		request.setAttribute(AppConstant.ATT_ERRORES_MSGS, erroresDTO);
		
		logger.error(method + "Fue descartado con exito la orden de compra que estaba en session.");
		
		controller.forward(erroresDTO, request, response, "/webpages/ajaxResults/showAjaxInfoMsgs.jsp");
		return;
	}
}
