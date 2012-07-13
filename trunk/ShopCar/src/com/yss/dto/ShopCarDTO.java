package com.yss.dto;

import java.util.HashMap;
import java.util.Map;

/**
 * 
 * Class: ShopCarDTO
 * Creation Date: 08/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public class ShopCarDTO {
	private int idVendedor = -1;
	private String nombreVendedor;
	private ClienteDTO cliente;
	private Map<String, ProductoDTO> productos = new HashMap<String, ProductoDTO>();
	
	public ShopCarDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getIdVendedor() {
		return idVendedor;
	}

	public void setIdVendedor(int idVendedor) {
		this.idVendedor = idVendedor;
	}

	public String getNombreVendedor() {
		return nombreVendedor;
	}

	public void setNombreVendedor(String nombreVendedor) {
		this.nombreVendedor = nombreVendedor;
	}

	public ClienteDTO getCliente() {
		return cliente;
	}

	public void setCliente(ClienteDTO cliente) {
		this.cliente = cliente;
	}
	
	public void addProductToCar(ProductoDTO producto, int cantidad){
		producto.setCantidadEnCarrito(producto.getCantidadEnCarrito() + cantidad);
		
		if(! productos.containsKey(producto.getIdProducto())){
			//el producto no existe, lo registramos
			productos.put(producto.getIdProducto(), producto);
		}
	}
	
	public int getShopCarSize(){
		return productos.size();
	}
	
	public ProductoDTO getProductFromCar(String idProducto){
		return productos.get(idProducto);
	}
}
