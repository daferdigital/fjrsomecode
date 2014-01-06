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
public enum CriterioBusquedaBiopsia {
	TODOS("Seleccione"),
	CEDULA("Cédula del paciente"),
	DIAGNOSTICO("Diagnostico"),
	ESPECIALIDAD("Especialidad"),
	EXAMEN("Examen"),
	FASE("Fase de la Biopsia"),
	MEDICO_QUE_REFIERE("Médico que refiere"),
	PACIENTE("Nombre de paciente"),
	PATOLOGO("Nombre del patologo"),
	NUMERO_BIOPSIA("Número de Biopsia"),
	PROCEDENCIA_DEL_MATERIAL("Procedencia del Material"),
	TIPO_DE_ESTUDIO("Tipo de Estudio"),
	//estos criterios no deben salir en el combo
	FECHA_DESDE("Tipo de Estudio", false),
	FECHA_HASTA("Tipo de Estudio", false),
	FASES_DE_ENTREGA("Fases de Entrega", false);
	
	private String textoDelCombo;
	private boolean showInCombo;
	
	/**
	 * 
	 * @param textoDelCombo
	 */
	private CriterioBusquedaBiopsia(String textoDelCombo) {
		// TODO Auto-generated constructor stub
		this(textoDelCombo, true);
	}
	
	/**
	 * 
	 * @param textoDelCombo
	 * @param showInCombo
	 */
	private CriterioBusquedaBiopsia(String textoDelCombo, boolean showInCombo) {
		// TODO Auto-generated constructor stub
		this.textoDelCombo = textoDelCombo;
		this.showInCombo = showInCombo;
	}
	
	public String getTextoDelCombo() {
		return textoDelCombo;
	}
	
	public boolean isShowInCombo() {
		return showInCombo;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return textoDelCombo;
	}
}
