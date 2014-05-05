package com.fjr.code.dto;

import java.util.Calendar;

/**
 * 
 * Class: DiagnosticoWizardDTO
 * Creation Date: 27/04/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class DiagnosticoWizardDTO {
	private int idBiopsia;
	private int idFirmante1;
	private int idFirmante2;
	private Calendar fechaWizard;
	private int numeroLinea;
	private String seccion;
	private String textoSeccion;
	private String nameFileImagen1;
	private byte[] dataFileImagen1;
	private String nameFileImagen2;
	private byte[] dataFileImagen2;
	private String nameFileImagen3;
	private byte[] dataFileImagen3;
	private String diagnosticoComplementario;
	private String comentarioComplementario;
	
	public DiagnosticoWizardDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getIdBiopsia() {
		return idBiopsia;
	}

	public void setIdBiopsia(int idBiopsia) {
		this.idBiopsia = idBiopsia;
	}

	public int getIdFirmante1() {
		return idFirmante1;
	}

	public void setIdFirmante1(int idFirmante1) {
		this.idFirmante1 = idFirmante1;
	}

	public int getIdFirmante2() {
		return idFirmante2;
	}

	public void setIdFirmante2(int idFirmante2) {
		this.idFirmante2 = idFirmante2;
	}

	public Calendar getFechaWizard() {
		return fechaWizard;
	}

	public void setFechaWizard(Calendar fechaWizard) {
		this.fechaWizard = fechaWizard;
	}

	public int getNumeroLinea() {
		return numeroLinea;
	}

	public void setNumeroLinea(int numeroLinea) {
		this.numeroLinea = numeroLinea;
	}

	public String getSeccion() {
		return seccion;
	}

	public void setSeccion(String seccion) {
		this.seccion = seccion;
	}

	public String getTextoSeccion() {
		return textoSeccion;
	}

	public void setTextoSeccion(String textoSeccion) {
		this.textoSeccion = textoSeccion;
	}

	public String getNameFileImagen1() {
		return nameFileImagen1;
	}

	public void setNameFileImagen1(String nameFileImagen1) {
		this.nameFileImagen1 = nameFileImagen1;
	}

	public byte[] getDataFileImagen1() {
		return dataFileImagen1;
	}

	public void setDataFileImagen1(byte[] dataFileImagen1) {
		this.dataFileImagen1 = dataFileImagen1;
	}

	public String getNameFileImagen2() {
		return nameFileImagen2;
	}

	public void setNameFileImagen2(String nameFileImagen2) {
		this.nameFileImagen2 = nameFileImagen2;
	}

	public byte[] getDataFileImagen2() {
		return dataFileImagen2;
	}

	public void setDataFileImagen2(byte[] dataFileImagen2) {
		this.dataFileImagen2 = dataFileImagen2;
	}

	public String getNameFileImagen3() {
		return nameFileImagen3;
	}

	public void setNameFileImagen3(String nameFileImagen3) {
		this.nameFileImagen3 = nameFileImagen3;
	}

	public byte[] getDataFileImagen3() {
		return dataFileImagen3;
	}

	public void setDataFileImagen3(byte[] dataFileImagen3) {
		this.dataFileImagen3 = dataFileImagen3;
	}
	
	public String getDiagnosticoComplementario() {
		return diagnosticoComplementario;
	}
	
	public void setDiagnosticoComplementario(String diagnosticoComplementario) {
		this.diagnosticoComplementario = diagnosticoComplementario;
	}
	
	public String getComentarioComplementario() {
		return comentarioComplementario;
	}
	
	public void setComentarioComplementario(String comentarioComplementario) {
		this.comentarioComplementario = comentarioComplementario;
	}
}
