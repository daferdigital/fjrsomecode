package com.fjr.code.gui.tables;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.util.LinkedList;
import java.util.List;
import java.util.Vector;

import javax.swing.JCheckBox;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.fjr.code.dao.ReactivoDAO;
import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasFileDTO;
import com.fjr.code.dto.ReactivoDTO;
import com.fjr.code.gui.MicroLaminasIHQDialog;

/**
 * 
 * Class: JTableMicroLaminasIHQ
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTableMicroLaminasIHQ {
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableMicroLaminasIHQ instance;
	
	/**
	 * 
	 */
	private JTableMicroLaminasIHQ() {
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
				if(table.getSelectedColumn() == 0 && table.getSelectedRow() > -1){
					e.consume();
					boolean selected = Boolean.parseBoolean(model.getValueAt(table.getSelectedRow(), 0).toString());
					model.setValueAt(! selected, table.getSelectedRow(), 0);
					JCheckBox check = new JCheckBox();
					check.setSelected(! selected);
				} else {
					if(e.getClickCount() == 2 && !e.isConsumed()) {
						new MicroLaminasIHQDialog(instance, 
								table.getSelectedRow(),
								Integer.parseInt(model.getValueAt(table.getSelectedRow(), 1).toString()),
								model.getValueAt(table.getSelectedRow(), 2).toString(),
								model.getValueAt(table.getSelectedRow(), 3).toString(),
								model.getValueAt(table.getSelectedRow(), 4).toString(),
								model.getValueAt(table.getSelectedRow(), 5).toString(),
								model.getValueAt(table.getSelectedRow(), 7).toString()).setVisible(true);
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
	public static JTableMicroLaminasIHQ getNewInstance(){
		instance = new JTableMicroLaminasIHQ();
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		model.addColumn("");
		model.addColumn("Cassete");
		model.addColumn("Bloque");
		model.addColumn("Lamina");
		model.addColumn("Resultado");
		model.addColumn("Reactivo");
		model.addColumn("idReactivo");
		model.addColumn("FilesMicro");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(25);
		table.getColumnModel().getColumn(1).setPreferredWidth(25);
		table.getColumnModel().getColumn(2).setPreferredWidth(20);
		table.getColumnModel().getColumn(3).setPreferredWidth(20);
		table.getColumnModel().getColumn(4).setPreferredWidth(150);
		table.getColumnModel().getColumn(5).setPreferredWidth(100);
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(7));
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(6));
		
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
	 * @param isSelected
	 * @param cassete
	 * @param bloque
	 * @param lamina
	 * @param descripcion
	 * @param idReactivo
	 * @param nombreReactivo
	 * @param pathToPictures
	 */
	public void addRow(boolean isSelected, String cassete, String bloque, String lamina, String descripcion, 
			int idReactivo, String nombreReactivo, String pathToPictures){
		Vector<Object> rowData = new Vector<Object>();
		rowData.add(isSelected);
		rowData.add(cassete);
		rowData.add(bloque);
		rowData.add(lamina);
		rowData.add(descripcion);
		rowData.add(nombreReactivo);
		rowData.add(idReactivo);
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
	public void updateRow(int row, String descripcion, String pathToPictures){
		if(row > -1){
			model.setValueAt(descripcion, row, 4);
			model.setValueAt(pathToPictures, row, 7);
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
				laminasDTO.setCassete(Integer.parseInt(model.getValueAt(i, 1).toString()));
				laminasDTO.setBloque(Integer.parseInt(model.getValueAt(i, 2).toString()));
				laminasDTO.setLamina(Integer.parseInt(model.getValueAt(i, 3).toString()));
				
				List<ReactivoDTO> reactivos = new LinkedList<ReactivoDTO>();
				ReactivoDTO tmpDTO = ReactivoDAO.getById(Integer.parseInt(model.getValueAt(i, 6).toString()));
				tmpDTO.setDescripcionIHQ(model.getValueAt(i, 4).toString());
				tmpDTO.setProcesadoIHQ(Boolean.parseBoolean(model.getValueAt(i, 0).toString()));
				reactivos.add(tmpDTO);
				laminasDTO.setReactivosDTO(reactivos);
				
				String[] pieces = model.getValueAt(i, 7).toString().split(";");
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
		boolean isValid = true;
		
		if(model.getRowCount() > 0){
			for (int i = 0; i < model.getRowCount(); i++) {
				//verificamos todos los campos re reactivos
				//para ver si es valido enviar a IHQ
				if(! Boolean.parseBoolean(model.getValueAt(i, 0).toString().trim())){
					isValid = false;
					break;
				}
			}
		}
		
		return isValid;
	}
}

