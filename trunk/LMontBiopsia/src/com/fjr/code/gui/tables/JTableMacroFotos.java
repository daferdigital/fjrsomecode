package com.fjr.code.gui.tables;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.io.File;
import java.io.FileInputStream;
import java.util.LinkedList;
import java.util.List;
import java.util.Vector;

import javax.swing.JButton;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.fjr.code.dto.BiopsiaMacroFotoDTO;
import com.fjr.code.gui.MacroFotosDialog;

/**
 * 
 * Class: JTableMacroFotos
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTableMacroFotos {
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableMacroFotos instance;
	
	/**
	 * 
	 */
	private JTableMacroFotos() {
		// TODO Auto-generated constructor stub
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
					return super.getValueAt(row, column);
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
					e.consume();
					model.removeRow(table.getSelectedRow());
				} else {
					//no hice click en la primera columna, quiere decir que quiero editar
					//el contenido del cassete
					if(e.getClickCount() == 2 && !e.isConsumed()) {
						new MacroFotosDialog(instance, 
								model.getValueAt(table.getSelectedRow(), 1).toString(),
								model.getValueAt(table.getSelectedRow(), 2).toString(),
								table.getSelectedRow(),
								model.getValueAt(table.getSelectedRow(), 3).toString(),
								Boolean.parseBoolean(model.getValueAt(table.getSelectedRow(), 4).toString())).setVisible(true);
						e.consume();
					}
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
	public static JTableMacroFotos getNewInstance(){
		instance = new JTableMacroFotos();
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		model.addColumn("");
		model.addColumn("Notación");
		model.addColumn("Descripción");
		model.addColumn("Foto");
		model.addColumn("Foto PerOperatoria");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(10);
		table.getColumnModel().getColumn(1).setPreferredWidth(30);
		table.getColumnModel().getColumn(2).setPreferredWidth(250);
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(4));
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(3));
		
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
		
		//indicamos que la primera columna tendra un renderizado de boton
		table.getColumn("").setCellRenderer(new JTableButtonRenderer());
	}
	
	public JTable getTable() {
		return table;
	}
	
	/**
	 * 
	 * @param notacion
	 * @param descripcion
	 * @param pathToPicture
	 * @param fotoPerOperatoria
	 */
	public void addRow(String notacion, String descripcion, String pathToPicture, boolean fotoPerOperatoria){
		Vector<Object> rowData = new Vector<Object>();
		rowData.add("X");
		rowData.add(notacion);
		rowData.add(descripcion);
		rowData.add(pathToPicture);
		rowData.add(fotoPerOperatoria);
		
		model.addRow(rowData);
	}
	
	/**
	 * 
	 * @param row
	 * @param notacion
	 * @param descripcion
	 * @param pathToPicture
	 */
	public void updateRow(int row, String notacion, String descripcion, String pathToPicture){
		if(row > -1){
			model.setValueAt(notacion, row, 1);
			model.setValueAt(descripcion, row, 2);
			model.setValueAt(pathToPicture, row, 3);
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
	 * 
	 * @return
	 */
	public List<BiopsiaMacroFotoDTO> getList(){
		List<BiopsiaMacroFotoDTO> lista = null;
		if(model.getRowCount() > 0){
			lista = new LinkedList<BiopsiaMacroFotoDTO>();
			
			for (int i = 0; i < model.getRowCount(); i++) {
				BiopsiaMacroFotoDTO macroFoto = new BiopsiaMacroFotoDTO();
				macroFoto.setNotacion(model.getValueAt(i, 1).toString());
				macroFoto.setDescripcion(model.getValueAt(i, 2).toString());
				macroFoto.setFotoPerOperatoria(Boolean.parseBoolean(model.getValueAt(i, 4).toString()));
				
				File fotoFile = null;
				if(model.getValueAt(i, 3) != null){
					fotoFile = new File(model.getValueAt(i, 3).toString());
				}
				
				try {
					macroFoto.setFotoFile(fotoFile);
					macroFoto.setFotoBlob(new FileInputStream(fotoFile));
				} catch (Throwable e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				
				lista.add(macroFoto);
			}
		}
		
		return lista;
	}
}

