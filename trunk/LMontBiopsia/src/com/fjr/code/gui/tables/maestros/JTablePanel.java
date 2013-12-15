package com.fjr.code.gui.tables.maestros;

import javax.swing.JTable;

/**
 * 
 * Class: JTablePanel
 * Creation Date: 15/12/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public interface JTablePanel {
	/**
	 * Metodo que dependiendo de un listado de DTOs devuelve
	 * un objeto <code>JTable</code> para colocar directo en el panel principal.
	 * 
	 * @return
	 */
	public JTable getJTable();
}
