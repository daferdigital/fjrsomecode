package com.fjr.code.gui.tables.maestros;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.List;
import java.util.Vector;

import javax.swing.JButton;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.fjr.code.dto.EspecialidadDTO;
import com.fjr.code.gui.maestros.EspecialidadDialog;
import com.fjr.code.gui.tables.JTableButtonRenderer;

/**
 * 
 * Class: JTableTiposDeEstudio
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTableEspecialidad implements JTablePanel{
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableEspecialidad instance;
	private List<EspecialidadDTO> listado;
	
	/**
	 * Si listado es distinto de null, se usa dicho listado
	 * sino, se usa el valor de la fase
	 * 
	 * @param faseABuscar
	 * @param listado
	 */
	public JTableEspecialidad(List<EspecialidadDTO> listado) {
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
					//se desea abrir el registro de determinada biopsia
					//en su frame correspondiente
					new EspecialidadDialog(
							(Integer) table.getValueAt(table.getSelectedRow(), 4)).setVisible(true);
					e.consume();
				}
			}
		});
		
		model = (DefaultTableModel) table.getModel();
		buildTable();
	}
	
	/**
	 * 
	 * @return
	 */
	public static JTableEspecialidad getNewInstance(List<EspecialidadDTO> listado){
		instance = new JTableEspecialidad(listado);
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		model.addColumn("");
		model.addColumn("Nombre");
		model.addColumn("Codigo");
		model.addColumn("Descripción");
		model.addColumn("Id Especialidad");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(100);
		table.getColumnModel().getColumn(1).setPreferredWidth(150);
		table.getColumnModel().getColumn(2).setPreferredWidth(50);
		table.getColumnModel().getColumn(3).setPreferredWidth(150);
		table.getColumnModel().getColumn(4).setPreferredWidth(150);
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(4));
		
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
		
		//indicamos que la primera columna tendra un renderizado de boton
		table.getColumnModel().getColumn(0).setCellRenderer(new JTableButtonRenderer());
		
		//buscamos los registros de biopsias activas para mostrarlos aqui
		for (EspecialidadDTO especialidadDTO : listado) {
			addRow(especialidadDTO.getId(),
					especialidadDTO.getNombre(), 
					especialidadDTO.getCodigo(),
					especialidadDTO.getDescripcion());
		}
	}
	
	public JTable getJTable() {
		return table;
	}
	
	/**
	 * 
	 * @param idEspecialidad
	 * @param nombre
	 * @param codigo
	 * @param descripcion
	 */
	public void addRow(int idEspecialidad, String nombre, String codigo,
			String descripcion){
		Vector<Object> rowData = new Vector<Object>();
		rowData.add("Abrir");
		rowData.add(nombre);
		rowData.add(codigo);
		rowData.add(descripcion);
		rowData.add(idEspecialidad);
		
		model.addRow(rowData);
	}
	
	/**
	 * 
	 * @param row
	 * @param nombre
	 * @param codigo
	 * @param descripcion
	 */
	public void updateRow(int row, String nombre, String codigo, String descripcion){
		if(row > -1){
			model.setValueAt(nombre, row, 1);
			model.setValueAt(codigo, row, 2);
			model.setValueAt(descripcion, row, 3);
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
