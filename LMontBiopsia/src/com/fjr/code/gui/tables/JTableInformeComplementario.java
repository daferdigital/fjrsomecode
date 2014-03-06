package com.fjr.code.gui.tables;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.List;
import java.util.Vector;

import javax.swing.JButton;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.tables.JTableButtonRenderer;

/**
 * 
 * Class: JTableInformeComplementario
 * Creation Date: 04/03/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class JTableInformeComplementario {
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableInformeComplementario instance;
	private List<BiopsiaInfoDTO> listado;
	
	/**
	 * 
	 * @param listado
	 */
	private JTableInformeComplementario(List<BiopsiaInfoDTO> listado) {
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
			
			@Override
			public Object getValueAt(int row, int column) {
				// TODO Auto-generated method stub
				if(column == 0){
					return new JButton(super.getValueAt(row, column).toString());
				} else {
					return model.getValueAt(row, column);
				}
			}
		};
		
		table.addMouseListener(new MouseListener() {
			
			@Override
			public void mouseReleased(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mousePressed(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mouseExited(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mouseEntered(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mouseClicked(MouseEvent e) {
				// TODO Auto-generated method stub
				if(table.getSelectedColumn() == 0 && table.getSelectedRow() > -1){
					//o se desea reimprimir el diagnostico complementario
					//o se desea crear uno nuevo
					final int idBiopsia = (Integer) table.getValueAt(table.getSelectedRow(), 4);
					
					e.consume();
				}
			}
		});
		
		model = (DefaultTableModel) table.getModel();
		buildTable();
	}
	
	/**
	 * 
	 * @param listado
	 * @return
	 */
	public static JTableInformeComplementario getNewInstance(List<BiopsiaInfoDTO> listado){
		instance = new JTableInformeComplementario(listado);
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		model.addColumn("");
		model.addColumn("N° de Biopsia");
		model.addColumn("Examen");
		model.addColumn("Paciente");
		model.addColumn("Id Biopsia");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(100);
		table.getColumnModel().getColumn(1).setPreferredWidth(350);
		table.getColumnModel().getColumn(2).setPreferredWidth(200);
		table.getColumnModel().getColumn(3).setPreferredWidth(150);
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(4));
		
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
		
		//indicamos que la primera columna tendra un renderizado de boton
		table.getColumnModel().getColumn(0).setCellRenderer(new JTableButtonRenderer());
		
		//buscamos los registros de biopsias activas para mostrarlos aqui
		if(listado != null){
			for (BiopsiaInfoDTO biopsiaInfoDTO : listado) {
				addRow(biopsiaInfoDTO.getId(),
						biopsiaInfoDTO.getCodigo(), 
						biopsiaInfoDTO.getExamenBiopsia().getNombreExamen(), 
						biopsiaInfoDTO.getCliente().getNombres() + " " + biopsiaInfoDTO.getCliente().getApellidos());
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
	public void addRow(int idBiopsia, String codigo, String examen, String cliente){
		Vector<Object> rowData = new Vector<Object>();
		
		rowData.add("Crear Informe Complementario");
		rowData.add(codigo);
		rowData.add(examen);
		rowData.add(cliente);
		rowData.add(idBiopsia);
		
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
