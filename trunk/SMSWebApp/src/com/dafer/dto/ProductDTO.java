package com.dafer.dto;

/**
 * 
 * Class: ProductDTO
 * Creation Date: 31/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class ProductDTO {
	private int id;
	private String nombre;
	private String descripcion;
	private double precioNetoActual;
	private double precioCostoActual;
	private int idCategoria;
	private String nombreCategoria;
	private int cantidadComprada;
	private int cantidadVendida;
	
	public ProductDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getDescripcion() {
		return descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public double getPrecioNetoActual() {
		return precioNetoActual;
	}

	public void setPrecioNetoActual(double precioNetoActual) {
		this.precioNetoActual = precioNetoActual;
	}

	public double getPrecioCostoActual() {
		return precioCostoActual;
	}

	public void setPrecioCostoActual(double precioCostoActual) {
		this.precioCostoActual = precioCostoActual;
	}

	public int getIdCategoria() {
		return idCategoria;
	}

	public void setIdCategoria(int idCategoria) {
		this.idCategoria = idCategoria;
	}

	public String getNombreCategoria() {
		return nombreCategoria;
	}
	
	public void setNombreCategoria(String nombreCategoria) {
		this.nombreCategoria = nombreCategoria;
	}
	
	public int getCantidadComprada() {
		return cantidadComprada;
	}

	public void setCantidadComprada(int cantidadComprada) {
		this.cantidadComprada = cantidadComprada;
	}

	public int getCantidadVendida() {
		return cantidadVendida;
	}

	public void setCantidadVendida(int cantidadVendida) {
		this.cantidadVendida = cantidadVendida;
	}
}
