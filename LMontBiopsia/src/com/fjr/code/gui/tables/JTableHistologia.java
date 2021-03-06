package com.fjr.code.gui.tables;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.LinkedList;
import java.util.List;
import java.util.Vector;

import javax.swing.JCheckBox;
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
			
			@Override
			public Object getValueAt(int row, int column) {
				// TODO Auto-generated method stub
				if(column == 0){
					JCheckBox check = new JCheckBox();
					check.setSelected(Boolean.parseBoolean(super.getValueAt(row, column).toString()));
					check.setEnabled(false);
					return check;
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
				if(e.getClickCount() == 2 && !e.isConsumed()) {
					e.consume();
					new HistologiaCasseteDialog(instance, 
							table.getSelectedRow(),
							table.getSelectedRow() + 1,
							model.getValueAt(table.getSelectedRow(), 4).toString(),
							Integer.parseInt(model.getValueAt(table.getSelectedRow(), 2).toString()),
							Integer.parseInt(model.getValueAt(table.getSelectedRow(), 3).toString())).setVisible(true);
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
		model.addColumn("");
		model.addColumn("Nro");
		model.addColumn("Bloques");
		model.addColumn("Laminas");
		model.addColumn("Descripción");
		model.addColumn("CodigoBiopsia");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(15);
		table.getColumnModel().getColumn(1).setPreferredWidth(10);
		table.getColumnModel().getColumn(2).setPreferredWidth(15);
		table.getColumnModel().getColumn(3).setPreferredWidth(15);
		table.getColumnModel().getColumn(4).setPreferredWidth(250);
		table.getColumnModel().getColumn(5).setPreferredWidth(250);
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(5));
		
		table.getColumn("").setCellRenderer(new JTableCheckBoxRenderer());
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
	}
	
	public JTable getTable() {
		return table;
	}
	
	/**
	 * 
	 * @param reprocesar
	 * @param numero
	 * @param bloques
	 * @param laminas
	 * @param descripcion
	 */
	public void addRow(boolean reprocesar, int numero, int bloques, int laminas, String descripcion,
			String codigoBiopsia){
		Vector<Object> rowData = new Vector<Object>();
		rowData.add(reprocesar);
		rowData.add("C" + numero);
		rowData.add(bloques < 0 ? 1 : bloques);
		rowData.add(laminas < 0 ? 1 : laminas);
		rowData.add(descripcion);
		rowData.add(codigoBiopsia);
		
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
			model.setValueAt(bloques, row, 2);
			model.setValueAt(laminas, row, 3);
		}
	}
	
	/**
	 * 
	 * @param row
	 * @return
	 */
	@SuppressWarnings("unchecked")
	public Vector<Object> getRowData(int row){
		if(row > -1){
			return (Vector<Object>) model.getDataVector().get(row);
		} else {
			return null;
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
				cassete.setReprocesar(Boolean.parseBoolean(model.getValueAt(i, 0).toString()));
				cassete.setNumero(i + 1);
				cassete.setBloques(Integer.parseInt(model.getValueAt(i, 2).toString()));
				cassete.setLaminas(Integer.parseInt(model.getValueAt(i, 3).toString()));
				cassete.setDescripcion(model.getValueAt(i, 4).toString());
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
				if(Integer.parseInt(model.getValueAt(i, 2).toString()) < 1
					|| (Integer.parseInt(model.getValueAt(i, 3).toString())) < 1){
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

