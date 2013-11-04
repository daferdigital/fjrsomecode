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
	TIPO_DE_ESTUDIO("Tipo de Estudio");
	
	private String textoDelCombo;
	private CriterioBusquedaBiopsia(String textoDelCombo) {
		// TODO Auto-generated constructor stub
		this.textoDelCombo = textoDelCombo;
	}
	
	public String getTextoDelCombo() {
		return textoDelCombo;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return textoDelCombo;
	}
}
