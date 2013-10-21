package com.fjr.code.gui.tables;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;
import java.util.SortedMap;
import java.util.TreeMap;
import java.util.Vector;

import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

/**
 * 
 * Class: JTableDiagnosticos
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTableDiagnosticoWizard {
	public static final String SECCION_MACRO = "macro";
	public static final String SECCION_IHQ = "ihq";
	public static final String SECCION_DIAGNOSTICO = "diagnostico";
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableDiagnosticoWizard instance;
	
	//mapas ordenados por linea para pasarlos al informe
	private SortedMap<Integer, List<String>> mapMacro = new TreeMap<Integer, List<String>>();
	private SortedMap<Integer, List<String>> mapIHQ = new TreeMap<Integer, List<String>>();
	private SortedMap<Integer, List<String>> mapDiagnostico = new TreeMap<Integer, List<String>>();
	
	/**
	 * 
	 */
	public JTableDiagnosticoWizard() {
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
				return super.getValueAt(row, column);
			}
			
			@Override
			public Class<?> getColumnClass(int column) {
				// TODO Auto-generated method stub
				if(column > 0){
					return ImageIcon.class;
				} else {
					return super.getColumnClass(column);
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
					fixMapsAfterDeleteRow(table.getSelectedRow());
					model.removeRow(table.getSelectedRow());
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
	public static JTableDiagnosticoWizard getNewInstance(){
		instance = new JTableDiagnosticoWizard();
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		model.addColumn("Desc");
		model.addColumn("Foto 1");
		model.addColumn("Foto 2");
		model.addColumn("Foto 3");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(100);
		table.getColumnModel().getColumn(1).setPreferredWidth(100);
		table.getColumnModel().getColumn(2).setPreferredWidth(100);
		table.getColumnModel().getColumn(3).setPreferredWidth(100);
		
		table.setRowHeight(50);
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
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
	public void addRow(JButton data){
		Vector<Object> rowData = new Vector<Object>();
		int currentRow = model.getRowCount();
		
		if(data.getIcon() == null){
			//debo dibujar texto
			rowData.add(data.getText());
			rowData.add("");
			rowData.add("");
			rowData.add("");
			model.addRow(rowData);
		} else {
			//debo dibujar una imagen
			//verificando la fila actual y la posicion de la misma
			if(currentRow == 0){
				rowData.add("");
				rowData.add(data.getIcon());
				rowData.add("");
				rowData.add("");
				model.addRow(rowData);
			} else {
				//ya la fila tiene imagenes
				//debo verificar si van 3 o aun no
				if(! (model.getValueAt(currentRow - 1, 1) instanceof Icon)){
					//la segunda columna no tiene imagen
					model.setValueAt(data.getIcon(), currentRow - 1, 1);
					currentRow--;
				} else if(! (model.getValueAt(currentRow - 1, 2) instanceof Icon)){
					//la tercera fila no tiene imagen
					model.setValueAt(data.getIcon(), currentRow - 1, 2);
					currentRow--;
				} else if(! (model.getValueAt(currentRow - 1, 3) instanceof Icon)){
					//la tercera fila no tiene imagen
					model.setValueAt(data.getIcon(), currentRow - 1, 3);
					currentRow--;
				} else {
					//ya esta copada la fila de imagenes, debo generar una nueva
					rowData.add("");
					rowData.add(data.getIcon());
					rowData.add("");
					rowData.add("");
					model.addRow(rowData);
				}
			}
		}
		
		SortedMap<Integer, List<String>> mapToUse = null;
		if(SECCION_MACRO.equals(data.getToolTipText())){
			mapToUse = mapMacro;
		} else if(SECCION_IHQ.equals(data.getToolTipText())){
			mapToUse = mapIHQ;
		} else if(SECCION_DIAGNOSTICO.equals(data.getToolTipText())){
			mapToUse = mapDiagnostico;
		}
		
		List<String> listToUse = null;
		//vemos si existe la lista para la linea actual
		if(mapToUse.containsKey(currentRow)){
			listToUse = mapToUse.get(currentRow); 
		} else {
			listToUse = new LinkedList<String>();
		}
		
		listToUse.add(data.getName());
		mapToUse.put(currentRow, listToUse);
		
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
		
		mapMacro = null;
		mapIHQ = null;
		mapDiagnostico = null;
		
		mapMacro = new TreeMap<Integer, List<String>>();
		mapIHQ = new TreeMap<Integer, List<String>>();
		mapDiagnostico = new TreeMap<Integer, List<String>>();
	}
	
	/**
	 * 
	 * @param rowDeleted
	 */
	private void fixMapsAfterDeleteRow(int rowDeleted){
		fixSpecificMap(mapMacro, rowDeleted);
		fixSpecificMap(mapIHQ, rowDeleted);
		fixSpecificMap(mapDiagnostico, rowDeleted);
	}
	
	/**
	 * 
	 * @param mapToFix
	 * @param rowDeleted
	 */
	private void fixSpecificMap(Map<Integer, List<String>> mapToFix,
			int rowDeleted){
		mapToFix.remove(rowDeleted);
		
		for (Integer lineNum : mapToFix.keySet()) {
			if(lineNum > rowDeleted){
				//debo ajustar el nuevo indice de esta linea
				mapToFix.put(lineNum - 1, 
						mapToFix.get(lineNum));
			}
		}
	}

	public SortedMap<Integer, List<String>> getMapMacro() {
		return mapMacro;
	}

	public SortedMap<Integer, List<String>> getMapIHQ() {
		return mapIHQ;
	}

	public SortedMap<Integer, List<String>> getMapDiagnostico() {
		return mapDiagnostico;
	}
}

