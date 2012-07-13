package com.yss.dto;

/**
 * 
 * Class: ProductoDTO
 * Creation Date: 08/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public class ProductoDTO {
	private String idProducto;
	private String descripcion;
	private int idLinea;
	private String linea;
	private int idMarca;
	private String marca;
	private int cantidadEnCarrito;
	
	public ProductoDTO() {
		// TODO Auto-generated constructor stub
	}

	public String getIdProducto() {
		return idProducto;
	}

	public void setIdProducto(String idProducto) {
		this.idProducto = idProducto;
	}

	public String getDescripcion() {
		return descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public int getIdLinea() {
		return idLinea;
	}

	public void setIdLinea(int idLinea) {
		this.idLinea = idLinea;
	}

	public String getLinea() {
		return linea;
	}

	public void setLinea(String linea) {
		this.linea = linea;
	}

	public int getIdMarca() {
		return idMarca;
	}

	public void setIdMarca(int idMarca) {
		this.idMarca = idMarca;
	}

	public String getMarca() {
		return marca;
	}

	public void setMarca(String marca) {
		this.marca = marca;
	}
	
	public void setCantidadEnCarrito(int cantidadEnCarrito) {
		this.cantidadEnCarrito = cantidadEnCarrito;
	}
	
	public int getCantidadEnCarrito() {
		return cantidadEnCarrito;
	}
}
