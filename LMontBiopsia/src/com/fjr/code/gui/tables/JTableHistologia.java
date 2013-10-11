package com.fjr.code.gui.tables;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.LinkedList;
import java.util.List;
import java.util.Vector;

import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.fjr.code.dto.BiopsiaCasseteDTO;
import com.fjr.code.gui.HistologiaCasseteDialog;

/**
 * 
 * Class: JTableHistologia
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTableHistologia {
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableHistologia instance;
	
	/**
	 * 
	 */
	private JTableHistologia() {
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
				if(e.getClickCount() == 2 && !e.isConsumed()) {
					e.consume();
					new HistologiaCasseteDialog(instance, 
							table.getSelectedRow(),
							table.getSelectedRow() + 1,
							model.getValueAt(table.getSelectedRow(), 3).toString(),
							Integer.parseInt(model.getValueAt(table.getSelectedRow(), 1).toString()),
							Integer.parseInt(model.getValueAt(table.getSelectedRow(), 2).toString())).setVisible(true);
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
	public static JTableHistologia getNewInstance(){
		instance = new JTableHistologia();
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		model.addColumn("Nro");
		model.addColumn("Bloques");
		model.addColumn("Laminas");
		model.addColumn("Descripción");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(10);
		table.getColumnModel().getColumn(1).setPreferredWidth(15);
		table.getColumnModel().getColumn(2).setPreferredWidth(15);
		table.getColumnModel().getColumn(3).setPreferredWidth(250);
		
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
	}
	
	public JTable getTable() {
		return table;
	}
	
	/**
	 * 
	 * @param numero
	 * @param bloques
	 * @param laminas
	 * @param descripcion
	 * 
	 */
	public void addRow(int numero, int bloques, int laminas, String descripcion){
		Vector<Object> rowData = new Vector<Object>();
		rowData.add("C" + numero);
		rowData.add(bloques < 0 ? 1 : bloques);
		rowData.add(laminas < 0 ? 1 : laminas);
		rowData.add(descripcion);
		
		model.addRow(rowData);
	}
	
	/**
	 * 
	 * @param row
	 * @param bloques
	 * @param laminas
	 */
	public void updateRow(int row, int bloques, int laminas){
		if(row > -1){
			model.setValueAt(bloques, row, 1);
			model.setValueAt(laminas, row, 2);
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
	public List<BiopsiaCasseteDTO> getList(){
		List<BiopsiaCasseteDTO> lista = null;
		if(model.getRowCount() > 0){
			lista = new LinkedList<BiopsiaCasseteDTO>();
			
			for (int i = 0; i < model.getRowCount(); i++) {
				BiopsiaCasseteDTO cassete = new BiopsiaCasseteDTO();
				cassete.setNumero(i + 1);
				cassete.setBloques(Integer.parseInt(model.getValueAt(i, 1).toString()));
				cassete.setLaminas(Integer.parseInt(model.getValueAt(i, 2).toString()));
				cassete.setDescripcion(model.getValueAt(i, 3).toString());
				lista.add(cassete);
			}
		}
		
		return lista;
	}
	
	/**
	 * Metodo para saber si de los cassetes involucrados, todos tienen una cantidad valida de laminas y bloques.
	 * 
	 * @return
	 */
	public boolean allCassetesHaveBlocksAndLaminas(){
		boolean result = true;
		
		if(model.getRowCount() > 0){
			for (int i = 0; i < model.getRowCount(); i++) {
				if(Integer.parseInt(model.getValueAt(i, 1).toString()) < 1
					|| (Integer.parseInt(model.getValueAt(i, 2).toString())) < 1){
					result = false;
					break;
				}
			}
		} else {
			result = false;
		}
		return result;
	}
}

