package com.fjr.code.gui.tables;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.LinkedList;
import java.util.List;
import java.util.Vector;

import javax.swing.JButton;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.fjr.code.dto.BiopsiaCasseteDTO;
import com.fjr.code.gui.MacroCasseteDialog;

/**
 * 
 * Class: JTableMacroCassetes
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTableMacroCassetes {
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableMacroCassetes instance;
	
	/**
	 * 
	 */
	private JTableMacroCassetes() {
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
					recalculateRows();
				} else {
					//no hice click en la primera columna, quiere decir que quiero editar
					//el contenido del cassete
					if(e.getClickCount() == 2 && !e.isConsumed()) {
						e.consume();
						new MacroCasseteDialog(instance, 
								model.getValueAt(table.getSelectedRow(), 2).toString(),
								table.getSelectedRow()).setVisible(true);
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
	public static JTableMacroCassetes getNewInstance(){
		instance = new JTableMacroCassetes();
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		model.addColumn("");
		model.addColumn("Nro Cassete");
		model.addColumn("Descripción");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(10);
		table.getColumnModel().getColumn(1).setPreferredWidth(30);
		table.getColumnModel().getColumn(2).setPreferredWidth(250);
		
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
	 * @param descripcion
	 */
	public void addRow(String descripcion){
		Vector<Object> rowData = new Vector<Object>();
		rowData.add("X");
		rowData.add(model.getRowCount() + 1);
		rowData.add(descripcion);
		
		model.addRow(rowData);
	}
	
	/**
	 * 
	 * @param row
	 * @param descripcion
	 */
	public void updateRow(int row, String descripcion){
		if(row > -1){
			model.setValueAt(descripcion, row, 2);
		}
	}
	
	/**
	 * 
	 * @param row
	 */
	public void recalculateRows(){
		for (int i = 0; i < table.getRowCount(); i++) {
			model.setValueAt((i + 1), i, 1);
		}
	}
	
	/**
	 * 
	 * @return
	 */
	public List<BiopsiaCasseteDTO> getList(){
		List<BiopsiaCasseteDTO> lista = null;
		if(model.getRowCount() > 0){
			lista = new LinkedList<BiopsiaCasseteDTO>();
			
			for (int i = 0; i < model.getRowCount(); i++) {
				BiopsiaCasseteDTO cassete = new BiopsiaCasseteDTO();
				cassete.setNumero(i + 1);
				cassete.setDescripcion(model.getValueAt(i, 2).toString());
				lista.add(cassete);
			}
		}
		
		return lista;
	}
}

