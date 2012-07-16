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
	private double precio1;
	private double precio2;
	private double precio3;
	private double precio4;
	private double precio5;
	private double[] precios;
	private int cantidadEnCarrito;
	
	public ProductoDTO() {
		// TODO Auto-generated constructor stub
		precios = new double[5];
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

	public double getPrecio1() {
		return precio1;
	}

	public void setPrecio1(double precio1) {
		this.precio1 = precio1;
		this.precios[0] = precio1;
	}

	public double getPrecio2() {
		return precio2;
	}

	public void setPrecio2(double precio2) {
		this.precio2 = precio2;
		this.precios[1] = precio2;
	}

	public double getPrecio3() {
		return precio3;
	}

	public void setPrecio3(double precio3) {
		this.precio3 = precio3;
		this.precios[2] = precio3;
	}

	public double getPrecio4() {
		return precio4;
	}

	public void setPrecio4(double precio4) {
		this.precio4 = precio4;
		this.precios[3] = precio4;
	}

	public double getPrecio5() {
		return precio5;
	}

	public void setPrecio5(double precio5) {
		this.precio5 = precio5;
		this.precios[4] = precio5;
	}
	
	public double getPriceOfClient(int priceToApply){
		return precios[priceToApply - 1];
	}
}
