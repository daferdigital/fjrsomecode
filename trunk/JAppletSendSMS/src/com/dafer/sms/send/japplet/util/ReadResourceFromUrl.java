package com.dafer.sms.send.japplet.util;

import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.net.MalformedURLException;
import java.net.URL;

/**
 * 
 * Class: ReadResourceFromUrl <br />
 * DateCreated: 02/10/2014 <br />
 * @author T&T <br />
 *
 */
public class ReadResourceFromUrl {
	private ReadResourceFromUrl() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param fileDestName
	 * @param urlSourceString
	 * @throws MalformedURLException
	 * @throws IOException
	 */
	public static void getDocumentFromUrl(String fileDestName, String urlSourceString) 
			throws MalformedURLException, IOException {
		DebugLog.info("Obteniendo url: '" + urlSourceString
				+ "'. Para almacenarlo en " + fileDestName);
		
		BufferedInputStream in = null;
		BufferedOutputStream bos = null;
		
		try {
			in = new BufferedInputStream(new URL(urlSourceString).openStream());
			bos = new BufferedOutputStream(new FileOutputStream(fileDestName));
			
			byte data[] = new byte[1024];
			int count;
			while ((count = in.read(data, 0, 1024)) != -1) {
				bos.write(data, 0, count);
			}
			bos.flush();
		} finally {
			try {
				in.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
			
			try {
				bos.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
		}
		
		DebugLog.info("Obtenido url: '" + urlSourceString
				+ "'. Y almacenado en " + fileDestName);
	}
}
