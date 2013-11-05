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
import com.fjr.code.util.OpenBiopsiaUtil;

/**
 * 
 * Class: JTableTodasBiopsias
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTableTodasBiopsias {
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableTodasBiopsias instance;
	private FasesBiopsia faseABuscar;
	private List<BiopsiaInfoDTO> listado;
	
	/**
	 * Si listado es distinto de null, se usa dicho listado
	 * sino, se usa el valor de la fase
	 * 
	 * @param faseABuscar
	 * @param listado
	 */
	public JTableTodasBiopsias(FasesBiopsia faseABuscar, List<BiopsiaInfoDTO> listado) {
		// TODO Auto-generated constructor stub
		this.faseABuscar = faseABuscar;
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
					//se desea abrir el registro de determinada biopsia
					//en su frame correspondiente
					OpenBiopsiaUtil.openBiopsia((String) table.getValueAt(table.getSelectedRow(), 1));
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
	public static JTableTodasBiopsias getNewInstance(FasesBiopsia faseABuscar, List<BiopsiaInfoDTO> listado){
		instance = new JTableTodasBiopsias(faseABuscar, listado);
		
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
		model.addColumn("Fase");
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
		
		//buscamos los registros de biopsias activas para mostrarlos aqui
		List<BiopsiaInfoDTO> biopsias = listado;
		if(listado == null){
			biopsias = BiopsiaInfoDAO.getBiopsiasEnFasesActivas(faseABuscar);
		}
		
		if(biopsias != null){
			for (BiopsiaInfoDTO biopsiaInfoDTO : biopsias) {
				addRow(biopsiaInfoDTO.getId(),
						biopsiaInfoDTO.getCodigo(), 
						biopsiaInfoDTO.getExamenBiopsia().getNombreExamen(), 
						biopsiaInfoDTO.getCliente().getNombres() + " " + biopsiaInfoDTO.getCliente().getApellidos(),
						biopsiaInfoDTO.getFaseActual().getNombreFase());
			}
		}
	}
	
	public JTable getTable() {
		return table;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @param codigo
	 * @param examen
	 * @param cliente
	 * @param fase
	 */
	public void addRow(int idBiopsia, String codigo, String examen, String cliente,
			String faseActual){
		Vector<Object> rowData = new Vector<Object>();
		if(FasesBiopsia.INFORME_IMPRESO.getNombreFase().equals(faseActual)){
			rowData.add("Reimprimir");
		} else if(FasesBiopsia.ENTREGA.getNombreFase().equals(faseActual)){
			rowData.add("Imprimir");
		} else {
			rowData.add("Abrir");
		}
		
		rowData.add(codigo);
		rowData.add(examen);
		rowData.add(cliente);
		rowData.add(faseActual);
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
