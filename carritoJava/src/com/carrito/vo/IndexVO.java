package com.carrito.vo;

import java.util.List;

import com.carrito.dto.CategoriaDTO;

public class IndexVO {
	private List<CategoriaDTO> categorias;
	
	public IndexVO() {
		// TODO Auto-generated constructor stub
	}

	public List<CategoriaDTO> getCategorias() {
		return categorias;
	}

	public void setCategorias(List<CategoriaDTO> categorias) {
		this.categorias = categorias;
	}
}
