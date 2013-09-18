package com.fjr.installer;

import java.io.IOException;

/**
 * 
 * Class: StartAsBatFile
 * Creation Date: 15/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class StartAsBatFile {
	public static void main(String[] args) throws IOException {
		Runtime.getRuntime().exec("java -cp LMontBiopsia.jar;. com/fjr/installer/Start");
	}
}
