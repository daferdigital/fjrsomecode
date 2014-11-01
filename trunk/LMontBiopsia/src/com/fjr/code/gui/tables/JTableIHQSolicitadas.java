package com.fjr.code.gui.tables;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.List;
import java.util.Vector;

import javax.swing.JButton;
import javax.swing.JOptionPane;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import org.apache.log4j.Logger;

import com.fjr.code.dao.BiopsiaInfoDAO;
import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaInfoDTO;

/**
 * 
 * Class: JTableDiagnosticos
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTableIHQSolicitadas {
	private static final Logger log = Logger.getLogger(JTableIHQSolicitadas.class);
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableIHQSolicitadas instance;
	
	/**
	 * 
	 */
	public JTableIHQSolicitadas() {
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
				if(column == 0 || column == 1){
					return new JButton(super.getValueAt(row, column).toString());
				} else if(column == 5){
					return model.getValueAt(row, column);
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
					//se desea aprobar la solicitud de IHQ
					int answer = JOptionPane.showConfirmDialog(table,
							"Esta seguro que desea Aprobar la solicitud de IHQ para esta biopsia?");
					if(answer == JOptionPane.YES_OPTION){
						BiopsiaInfoDAO.moveBiopsiaToFase(
								Integer.parseInt(table.getValueAt(table.getSelectedRow(), 5).toString()), 
								FasesBiopsia.IHQ);
						deleteSpecificRow(table.getSelectedRow());
					} 
				} else if(table.getSelectedColumn() == 1 && table.getSelectedRow() > -1){
					//se desea rechazar la solicitud de IHQ
					int answer = JOptionPane.showConfirmDialog(table,
							"Esta seguro que desea Rechazar la solicitud de IHQ para esta biopsia?");
					if(answer == JOptionPane.YES_OPTION){
						BiopsiaInfoDAO.moveBiopsiaToFase(
								Integer.parseInt(table.getValueAt(table.getSelectedRow(), 5).toString()), 
								FasesBiopsia.RECHAZADA_IHQ);
						deleteSpecificRow(table.getSelectedRow());
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
	public static JTableIHQSolicitadas getNewInstance(){
		instance = new JTableIHQSolicitadas();
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		log.info("Llenando tabla de IHQs solicitadas");
		
		model.addColumn("");
		model.addColumn("");
		model.addColumn("N° de Biopsia");
		model.addColumn("Examen");
		model.addColumn("Paciente");
		model.addColumn("Id Biopsia");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(100);
		table.getColumnModel().getColumn(1).setPreferredWidth(100);
		table.getColumnModel().getColumn(2).setPreferredWidth(100);
		table.getColumnModel().getColumn(3).setPreferredWidth(150);
		table.getColumnModel().getColumn(4).setPreferredWidth(150);
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(5));
		
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
		
		//indicamos que la primera columna tendra un renderizado de boton
		table.getColumnModel().getColumn(0).setCellRenderer(new JTableButtonRenderer());
		table.getColumnModel().getColumn(1).setCellRenderer(new JTableButtonRenderer());
		
		//buscamos los registros que esten en fase de confirmar IHQ
		List<BiopsiaInfoDTO> biopsias = BiopsiaInfoDAO.getBiopsiasByFase(FasesBiopsia.CONFIRMAR_IHQ);
		if(biopsias != null){
			for (BiopsiaInfoDTO biopsiaInfoDTO : biopsias) {
				addRow(biopsiaInfoDTO.getId(),
						biopsiaInfoDTO.getCodigo(), 
						biopsiaInfoDTO.getExamenBiopsia().getNombreExamen(), 
						biopsiaInfoDTO.getCliente().getNombres() + " " + biopsiaInfoDTO.getCliente().getApellidos());
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
	public void addRow(int idBiopsia, String codigo, String examen, String cliente){
		Vector<Object> rowData = new Vector<Object>();
		rowData.add("Aprobar");
		rowData.add("Rechazar");
		rowData.add(codigo);
		rowData.add(examen);
		rowData.add(cliente);
		rowData.add(idBiopsia);
		
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
	 * Eliminamos las filas de la tabla
	 */
	public void deleteSpecificRow(int indexRow){
		if(indexRow > -1){
			model.removeRow(indexRow);
		}
	}
}

