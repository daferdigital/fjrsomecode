package com.fjr.code.util;

import java.io.FileNotFoundException;
import java.io.IOException;
import java.net.URL;
import java.net.URLConnection;

public final class RemoteFileUtil {
	private RemoteFileUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param nameFile
	 * @return
	 */
	public static int getRemoteFileLength(String nameFile) {
		URL url;
		URLConnection connection;
		int fileSize = 0;

		try {
			url = new URL(nameFile);

			connection = url.openConnection();
			fileSize = connection.getContentLength();

			if (fileSize < 0)
				System.err.println("No se puede determinar el tamaño del archivo.");
			else
				System.out.println(nameFile + "\nSize: " + fileSize);

			connection.getInputStream().close();
		} catch (FileNotFoundException e) {
			return 0;
		} catch (IOException e) {
			e.printStackTrace();
		}
		return fileSize;
	}
}
