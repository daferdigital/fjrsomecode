package com.fjr.code.dto;

public class ReactivoDTO {
	private int id;
	private String nombre;
	private String abreviatura;
	private double precio;
	private CategoriaReactivoDTO categoriaReactivoDTO;
	private boolean procesadoIHQ;
	private String descripcionIHQ;
	
	public ReactivoDTO() {
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

	public String getAbreviatura() {
		return abreviatura;
	}

	public void setAbreviatura(String abreviatura) {
		this.abreviatura = abreviatura;
	}
	
	public double getPrecio() {
		return precio;
	}
	
	public void setPrecio(double precio) {
		this.precio = precio;
	}
	
	public CategoriaReactivoDTO getCategoriaReactivoDTO() {
		return categoriaReactivoDTO;
	}

	public void setCategoriaReactivoDTO(CategoriaReactivoDTO categoriaReactivoDTO) {
		this.categoriaReactivoDTO = categoriaReactivoDTO;
	}
	
	public boolean isProcesadoIHQ() {
		return procesadoIHQ;
	}

	public void setProcesadoIHQ(boolean procesadoIHQ) {
		this.procesadoIHQ = procesadoIHQ;
	}

	public String getDescripcionIHQ() {
		return descripcionIHQ;
	}

	public void setDescripcionIHQ(String descripcionIHQ) {
		this.descripcionIHQ = descripcionIHQ;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return this.nombre;
	}
}
