package com.fjr.code.dto;

import java.io.File;
import java.io.FileInputStream;

/**
 * 
 * Class: BiopsiaMicroLaminasFileDTO
 * Creation Date: 15/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaMicroLaminasFileDTO {
	private int id;
	private int cassete;
	private int bloque;
	private int lamina;
	private File mediaFile;
	private FileInputStream fileStream;
	
	public BiopsiaMicroLaminasFileDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getCassete() {
		return cassete;
	}

	public void setCassete(int cassete) {
		this.cassete = cassete;
	}

	public int getBloque() {
		return bloque;
	}

	public void setBloque(int bloque) {
		this.bloque = bloque;
	}

	public int getLamina() {
		return lamina;
	}

	public void setLamina(int lamina) {
		this.lamina = lamina;
	}

	public File getMediaFile() {
		return mediaFile;
	}

	public void setMediaFile(File mediaFile) {
		this.mediaFile = mediaFile;
	}

	public FileInputStream getFileStream() {
		return fileStream;
	}

	public void setFileStream(FileInputStream fileStream) {
		this.fileStream = fileStream;
	}
}
