package com.fjr.code.dao.definitions;

/**
 * 
 * Class: CriterioBusquedaBiopsiaDAO
 * Creation Date: 02/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public enum Meses {
	TODOS("Seleccione", 0),
	ENERO("Enero", 1),
	FEBRERO("Febrero", 2),
	MARZO("Marzo", 3),
	ABRIL("Abril", 4),
	MAYO("Mayo", 5),
	JUNIO("Junio", 6),
	JULIO("Julio", 7),
	AGOSTO("Agosto", 8),
	SEPTIEMBRE("Septiembre", 9),
	OCTUBRE("Octubre", 10),
	NOVIEMBRE("Noviembre", 11),
	DICIEMBRE("Diciembre", 12);
	
	private String textoDelCombo;
	private int valorDelMes;
	private Meses(String textoDelCombo, int valorDelMes) {
		// TODO Auto-generated constructor stub
		this.textoDelCombo = textoDelCombo;
		this.valorDelMes = valorDelMes;
	}
	
	public String getTextoDelCombo() {
		return textoDelCombo;
	}
	
	public int getValorDelMes() {
		return valorDelMes;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return textoDelCombo;
	}
}
