package com.carrito.dao;

import java.util.LinkedList;
import java.util.List;

import org.apache.log4j.Logger;
import org.apache.struts.action.ActionErrors;
import org.apache.struts.action.ActionMessage;

import com.carrito.dto.CarritoItemDTO;
import com.carrito.dto.ProductDTO;
import com.carrito.forms.BasketForm;
import com.carrito.util.Constants;
import com.carrito.util.DBUtil;

/**
 * 
 * Class: CompraDAO
 * Creation Date: 06/04/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class CompraDAO {
	private static final Logger log = Logger.getLogger(CompraDAO.class);
	
	private CompraDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param cestaDeCompra
	 * @return
	 */
	public static ActionErrors registrarCompra(BasketForm cestaDeCompra){
		ActionErrors errors = new ActionErrors();
		double total = 0;
		
		if("".equals(cestaDeCompra.getNroTarjetaCheque().trim())){
			errors.add("carrito.nrotarjetacheque.vacio", new ActionMessage("carrito.nrotarjetacheque.vacio"));
			return errors;
		}
		
		//primero verificamos inventario sobre los productos a comprar
		for (int i = 0; i < cestaDeCompra.getProductosSeleccionados().length; i++) {
			if(cestaDeCompra.getCantidadesSeleccionadas()[i] > 0){
				//este producto fue efectivamente seleccionado en la pre orden
				//verificamos su inventario
				ProductDTO producto = ProductoDAO.getProductInfo(cestaDeCompra.getProductosSeleccionados()[i]);
				
				boolean existeInventario = InventarioDAO.existeInventario(cestaDeCompra.getProductosSeleccionados()[i], 
						cestaDeCompra.getCantidadesSeleccionadas()[i]);
				
				if(! existeInventario){
					errors.add("carrito.producto.noinventario",
							new ActionMessage("carrito.producto.noinventario", new Object[]{producto.getNombre(), 
									cestaDeCompra.getCantidadesSeleccionadas()[i]}));
				}else{
					total += producto.getPrecioNetoActual() * cestaDeCompra.getCantidadesSeleccionadas()[i];
				}
			}
		}
		
		if(errors.size() > 0){
			//tenemos fallas para suplir el inventario, no vale la pena seguir el proceso
			log.info("No se disponia de inventario para alguno de los productos solicitados, frenamos el proceso de compra");
			return errors;
		}
		
		//si no tenemos errores quiere decir que la verificacion de inventario fue exitosa
		log.info("Verificacion de inventario exitosa para los productos solicitados");
		
		
		final String queryDetalle = "INSERT INTO venta_detalle (id_venta, id_producto, cantidad_vendida, precio_unitario, precio_total)"
				+ " VALUES(?,?,?,?,?)";
		final String ajustarInventario = "UPDATE producto" 
				+ " SET cantidad_comprada=cantidad_comprada - ?, "
				+ " cantidad_vendida=cantidad_comprada - ?"
				+ " WHERE id=?";
		
		//creamos el registro maestro de la compra
		final String query = "INSERT INTO venta(fecha, monto_sin_iva, iva, nro_documento_pago, id_usuario, id_banco, id_tipo_pago)"
				+ " VALUES(NOW(),?,ROUND(?, 2),?,?,?,?)";
		final List<Object> queryParameters = new LinkedList<Object>();
		double iva = total * Constants.IVA;
		
		queryParameters.add(total - iva);
		queryParameters.add(iva);
		queryParameters.add(cestaDeCompra.getNroTarjetaCheque());
		queryParameters.add(cestaDeCompra.getUserId());
		queryParameters.add(cestaDeCompra.getIdBanco());
		queryParameters.add(cestaDeCompra.getIdTipoPago());
		
		int idVenta = DBUtil.executeInsertQuery(query, queryParameters);
		
		//procedemos a realizar los ajustes de compras y eliminacion del carrito temporal
		for (int i = 0; i < cestaDeCompra.getProductosSeleccionados().length; i++) {
			if(cestaDeCompra.getCantidadesSeleccionadas()[i] > 0){
				//este producto fue efectivamente seleccionado en la pre orden
				//lo agregamos a la compra y lo eliminamos del temporal
				CarritoItemDTO itemDTO = new CarritoItemDTO();
				itemDTO.setUserId(cestaDeCompra.getUserId());
				itemDTO.setProductId(cestaDeCompra.getProductosSeleccionados()[i]);
				
				CarritoItemDAO.deleteProductFromBasket(itemDTO);
				
				ProductDTO producto = ProductoDAO.getProductInfo(cestaDeCompra.getProductosSeleccionados()[i]);
				
				queryParameters.clear();
				queryParameters.add(idVenta);
				queryParameters.add(cestaDeCompra.getProductosSeleccionados()[i]);
				queryParameters.add(cestaDeCompra.getCantidadesSeleccionadas()[i]);
				queryParameters.add(producto.getPrecioNetoActual());
				queryParameters.add(producto.getPrecioNetoActual() * cestaDeCompra.getCantidadesSeleccionadas()[i]);
				
				DBUtil.executeInsertQuery(queryDetalle, queryParameters);
				
				queryParameters.clear();
				queryParameters.add(cestaDeCompra.getCantidadesSeleccionadas()[i]);
				queryParameters.add(cestaDeCompra.getCantidadesSeleccionadas()[i]);
				queryParameters.add(cestaDeCompra.getProductosSeleccionados()[i]);
				DBUtil.executeNonSelectQuery(ajustarInventario, queryParameters);
			}
		}
		
		return errors;
	}
}
