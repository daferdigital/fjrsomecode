package com.fjr.code.gui.tables;

import java.util.List;
import java.util.Vector;

import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.fjr.code.dto.AuditoriaBiopsiaDTO;

/**
 * 
 * Class: JTableAuditoriaBiopsia
 * Creation Date: 05/01/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class JTableAuditoriaBiopsia {
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableAuditoriaBiopsia instance;
	private List<AuditoriaBiopsiaDTO> listado;
	
	/**
	 * 
	 * @param listado
	 * @param entregaMaterial
	 */
	private JTableAuditoriaBiopsia(List<AuditoriaBiopsiaDTO> listado) {
		// TODO Auto-generated constructor stub
		this.listado = listado;
		
		table = new JTable(){
			/**
			 * 
			 */
			private static final long serialVersionUID = 5179374112173369070L;

			@Override
			public boolean isCellEditable(int row, int column) {
				// TODO Auto-generated method stub
				return false;
			}
		};
		
		model = (DefaultTableModel) table.getModel();
		buildTable();
	}
	
	/**
	 * 
	 * @param listado
	 * @param entregaMaterial
	 * @return
	 */
	public static JTableAuditoriaBiopsia getNewInstance(List<AuditoriaBiopsiaDTO> listado){
		instance = new JTableAuditoriaBiopsia(listado);
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		model.addColumn("Tipo de Estudio");
		model.addColumn("Cantidad");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(350);
		table.getColumnModel().getColumn(1).setPreferredWidth(100);
		
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
		
		
		//buscamos los registros de biopsias activas para mostrarlos aqui
		if(listado != null){
			for (AuditoriaBiopsiaDTO auditoriaBiopsiaDTO : listado) {
				addRow(auditoriaBiopsiaDTO.getNombreEstudio(),
						auditoriaBiopsiaDTO.getCantidad());
			}
		}
	}
	
	public JTable getJTable() {
		return table;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @param codigo
	 * @param examen
	 * @param cliente
	*/
	public void addRow(String nombreEstudio, int cantidad){
		Vector<Object> rowData = new Vector<Object>();
		rowData.add(nombreEstudio);
		rowData.add(cantidad);
		
		model.addRow(rowData);
	}
	
	
	/**
	 * 
	 * @param row
	 * @param nombre
	 * @param abreviatura
	 */
	public void updateRow(int row, String nombre, String abreviatura){
		if(row > -1){
			model.setValueAt(nombre, row, 1);
			model.setValueAt(abreviatura, row, 2);
		}
	}
	
	/**
	 * Eliminamos las filas de la tabla
	 */
	public void deleteAllRows(){
		for (int i = model.getRowCount(); i > 0; i--) {
			model.removeRow(i - 1);
		}
	}
	
	/**
	 * Eliminamos las filas de la tabla
	 */
	public void deleteSpecificRow(int indexRow){
		if(indexRow > -1){
			model.removeRow(indexRow);
		}
	}
}
