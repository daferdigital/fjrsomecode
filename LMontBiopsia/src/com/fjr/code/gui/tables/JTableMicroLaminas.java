package com.fjr.code.gui.tables;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.util.LinkedList;
import java.util.List;
import java.util.Vector;

import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasFileDTO;
import com.fjr.code.dto.ReactivoDTO;
import com.fjr.code.gui.MicroLaminasDialog;
import com.fjr.code.util.Constants;

/**
 * 
 * Class: JTableMacroCassetes
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTableMicroLaminas {
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableMicroLaminas instance;
	
	/**
	 * 
	 */
	private JTableMicroLaminas() {
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
					new MicroLaminasDialog(instance, 
							table.getSelectedRow(),
							Integer.parseInt(model.getValueAt(table.getSelectedRow(), 0).toString()),
							model.getValueAt(table.getSelectedRow(), 1).toString(),
							model.getValueAt(table.getSelectedRow(), 2).toString(),
							model.getValueAt(table.getSelectedRow(), 3).toString(),
							model.getValueAt(table.getSelectedRow(), 5).toString(),
							model.getValueAt(table.getSelectedRow(), 6).toString()).setVisible(true);
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
	public static JTableMicroLaminas getNewInstance(){
		instance = new JTableMicroLaminas();
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		model.addColumn("Cassete");
		model.addColumn("Bloque");
		model.addColumn("Lamina");
		model.addColumn("Descripción");
		model.addColumn("Reactivo");
		model.addColumn("idReactivo");
		model.addColumn("FilesMicro");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(25);
		table.getColumnModel().getColumn(1).setPreferredWidth(20);
		table.getColumnModel().getColumn(2).setPreferredWidth(20);
		table.getColumnModel().getColumn(3).setPreferredWidth(150);
		table.getColumnModel().getColumn(4).setPreferredWidth(100);
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(6));
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(5));
		
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
	}
	
	public JTable getTable() {
		return table;
	}
	
	/**
	 * 
	 * @param cassete
	 * @param bloque
	 * @param lamina
	 * @param descripcion
	 * @param reactivo
	 * @param pathToMacroFoto
	 * @param pathToPictures
	 */
	public void addRow(String cassete, String bloque, String lamina, String descripcion, 
			String idsReactivo, String nombreReactivo, String pathToPictures){
		Vector<Object> rowData = new Vector<Object>();
		rowData.add(cassete);
		rowData.add(bloque);
		rowData.add(lamina);
		rowData.add(descripcion);
		rowData.add(nombreReactivo);
		rowData.add(idsReactivo);
		rowData.add(pathToPictures);
		
		model.addRow(rowData);
	}
	
	/**
	 * 
	 * @param row
	 * @param descripcion
	 * @param reactivo
	 * @param pathToPictures
	 */
	public void updateRow(int row, String descripcion, String reactivos, String idsReactivo, String pathToPictures){
		if(row > -1){
			model.setValueAt(descripcion, row, 3);
			model.setValueAt(reactivos, row, 4);
			model.setValueAt(idsReactivo, row, 5);
			model.setValueAt(pathToPictures, row, 6);
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
	public List<BiopsiaMicroLaminasDTO> getList(){
		List<BiopsiaMicroLaminasDTO> lista = null;
		if(model.getRowCount() > 0){
			lista = new LinkedList<BiopsiaMicroLaminasDTO>();
			
			for (int i = 0; i < model.getRowCount(); i++) {
				BiopsiaMicroLaminasDTO laminasDTO = new BiopsiaMicroLaminasDTO();
				laminasDTO.setCassete(Integer.parseInt(model.getValueAt(i, 0).toString()));
				laminasDTO.setBloque(Integer.parseInt(model.getValueAt(i, 1).toString()));
				laminasDTO.setLamina(Integer.parseInt(model.getValueAt(i, 2).toString()));
				laminasDTO.setDescripcion(model.getValueAt(i, 3).toString());
				
				String[] pieces = model.getValueAt(i, 5).toString().split(";");
				if(pieces != null && pieces.length > 0){
					List<ReactivoDTO> reactivos = new LinkedList<ReactivoDTO>();
					for (String id : pieces) {
						if(! Integer.toString(Constants.REACTIVO_VACIO).equals(id)){
							ReactivoDTO tmp = new ReactivoDTO();
							tmp.setId(Integer.parseInt(id));
							
							reactivos.add(tmp);
						}
					}
					
					laminasDTO.setReactivosDTO(reactivos);
				}
				
				pieces = model.getValueAt(i, 6).toString().split(";");
				if(pieces != null && pieces.length > 0){
					List<BiopsiaMicroLaminasFileDTO> files = new LinkedList<BiopsiaMicroLaminasFileDTO>();
					
					for (String filePath : pieces) {
						BiopsiaMicroLaminasFileDTO tmp = new BiopsiaMicroLaminasFileDTO();
						File f = new File(filePath);
						if(f.exists()){
							tmp.setMediaFile(f);
							
							try {
								tmp.setFileStream(new FileInputStream(f));
							} catch (FileNotFoundException e) {
								// TODO Auto-generated catch block
								e.printStackTrace();
							}
							
							files.add(tmp);
						}
					}
					
					laminasDTO.setMicroLaminasFilesDTO(files);
				}
				
				lista.add(laminasDTO);
			}
		}
		
		return lista;
	}
	
	/**
	 * 
	 * @return
	 */
	public boolean isValidForIHQ(){
		boolean isValid = false;
		
		if(model.getRowCount() > 0){
			for (int i = 0; i < model.getRowCount(); i++) {
				//verificamos todos los campos re reactivos
				//para ver si es valido enviar a IHQ
				if(! "".equals(model.getValueAt(i, 4).toString().trim())){
					isValid = true;
					break;
				}
			}
		}
		
		return isValid;
	}
}

