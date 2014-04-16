package com.fjr.code.gui.tables;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.io.File;
import java.sql.SQLException;
import java.util.Calendar;
import java.util.LinkedList;
import java.util.List;
import java.util.Vector;

import javax.sql.rowset.CachedRowSet;
import javax.swing.JButton;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import org.apache.log4j.Logger;

import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.gui.InformeComplementarioDialog;
import com.fjr.code.gui.PrepareInformeComplementarioDialog;
import com.fjr.code.gui.tables.JTableButtonRenderer;
import com.fjr.code.util.BLOBToDiskUtil;
import com.fjr.code.util.Constants;
import com.fjr.code.util.DBUtil;

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
	private static final Logger log = Logger.getLogger(JTableInformeComplementario.class);
	
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
					//validamos la existencia o no de un informe complementario previo
					//traemos el ultimo informe complementario impreso al disco
					final String query = "SELECT informe_complementario FROM biopsias WHERE id=?";
					List<Object> parameters = new LinkedList<Object>();
					parameters.add(idBiopsia);
					
					CachedRowSet rows = DBUtil.executeSelectQuery(query, parameters);
					try {
						if(rows.next() && rows.getBytes(1) != null){
							File diagnostico = new File(Constants.TMP_PATH + File.separator 
									+ Constants.PREFIJO_PDF_INFORME_COMPLEMENTARIO + idBiopsia + ".pdf");
							BLOBToDiskUtil.writeBLOBToDisk(diagnostico, 
									rows.getBytes(1));
							
							new InformeComplementarioDialog(diagnostico.getAbsolutePath(), 
									idBiopsia).setVisible(true);
						} else {
							//no se obtuvo informe complementario,
							//mostramos directo la ventana de preparacion
							new PrepareInformeComplementarioDialog(idBiopsia).setVisible(true);
						}
					} catch (SQLException ex) {
						// TODO Auto-generated catch block
						log.error("", ex);
					}
					
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
		model.addColumn("Fecha Última Impresión");
		model.addColumn("Id Biopsia");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(150);
		table.getColumnModel().getColumn(1).setPreferredWidth(70);
		table.getColumnModel().getColumn(2).setPreferredWidth(280);
		table.getColumnModel().getColumn(3).setPreferredWidth(150);
		table.getColumnModel().getColumn(4).setPreferredWidth(100);
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(5));
		
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
						biopsiaInfoDTO.getCliente().getNombres() + " " + biopsiaInfoDTO.getCliente().getApellidos(),
						biopsiaInfoDTO.getFechaImpresionComplementario());
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
	 * @param fechaImpresion
	 */
	public void addRow(int idBiopsia, String codigo, String examen, String cliente,
			Calendar fechaImpresion){
		Vector<Object> rowData = new Vector<Object>();
		
		if(fechaImpresion == null){
			rowData.add("Crear Informe Complementario");
		} else {
			rowData.add("Ver Informe Previo");
		}
		
		rowData.add(codigo);
		rowData.add(examen);
		rowData.add(cliente);
		rowData.add(fechaImpresion != null ? Constants.sdfDDMMYYYY.format(fechaImpresion.getTime()) : "");
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
