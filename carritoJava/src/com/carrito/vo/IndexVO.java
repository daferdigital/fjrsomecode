package com.carrito.vo;

import java.util.List;

import com.carrito.dto.CategoriaDTO;

/**
 * 
 * Class: IndexVO
 * Creation Date: 06/04/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
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
