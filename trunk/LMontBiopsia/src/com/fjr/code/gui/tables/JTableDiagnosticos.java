package com.fjr.code.gui.tables;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.List;
import java.util.Vector;

import javax.swing.JButton;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.pdf.BiopsiaDiagnostico;

/**
 * 
 * Class: JTableDiagnosticos
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTableDiagnosticos {
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableDiagnosticos instance;
	
	/**
	 * 
	 */
	public JTableDiagnosticos() {
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
					openDiagnostico(table.getSelectedRow());
				} else {
					//no hice click en la primera columna, quiere decir que quiero editar
					//el contenido del cassete
					if(e.getClickCount() == 2 && !e.isConsumed()) {
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
	public static JTableDiagnosticos getNewInstance(){
		instance = new JTableDiagnosticos();
		
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
		
		table.getColumnModel().getColumn(0).setPreferredWidth(55);
		table.getColumnModel().getColumn(1).setPreferredWidth(55);
		table.getColumnModel().getColumn(2).setPreferredWidth(150);
		table.getColumnModel().getColumn(3).setPreferredWidth(150);
		
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
		
		//indicamos que la primera columna tendra un renderizado de boton
		table.getColumn("").setCellRenderer(new JTableButtonRenderer());
		
		//buscamos los registros que esten en fase de diagnostico ya realizado
		List<BiopsiaInfoDTO> biopsias = BiopsiaInfoDAO.getBiopsiasByFase(FasesBiopsia.ENTREGA);
		if(biopsias != null){
			for (BiopsiaInfoDTO biopsiaInfoDTO : biopsias) {
				addRow(biopsiaInfoDTO.getCodigo(), 
						biopsiaInfoDTO.getExamenBiopsia().getNombreExamen(), 
						biopsiaInfoDTO.getCliente().getNombres() + biopsiaInfoDTO.getCliente().getApellidos());
			}
		}
	}
	
	public JTable getTable() {
		return table;
	}
	
	/**
	 * 
	 * @param codigo
	 * @param examen
	 * @param cliente
	 */
	public void addRow(String codigo, String examen, String cliente){
		Vector<Object> rowData = new Vector<Object>();
		rowData.add("ABRIR");
		rowData.add(codigo);
		rowData.add(examen);
		rowData.add(cliente);
		
		model.addRow(rowData);
	}
	
	/**
	 * 
	 * @param row
	 * @param codigo
	 * @param examen
	 * @param cliente
	 */
	public void updateRow(int row, String codigo, String examen, String cliente){
		if(row > -1){
			model.setValueAt(codigo, row, 1);
			model.setValueAt(examen, row, 2);
			model.setValueAt(cliente, row, 3);
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
	 * @param selectedRow
	 */
	private void openDiagnostico(int selectedRow) {
		// TODO Auto-generated method stub
		BiopsiaDiagnostico diagnostico = new BiopsiaDiagnostico(
				BiopsiaInfoDAO.getBiopsiaByNumero(
						model.getValueAt(selectedRow, 1).toString()));
		diagnostico.buildDiagnostico();
		diagnostico.open();
	}
}

