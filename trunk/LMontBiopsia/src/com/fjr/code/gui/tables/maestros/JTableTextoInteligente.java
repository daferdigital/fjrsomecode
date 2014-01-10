package com.fjr.code.gui.tables.maestros;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.List;
import java.util.Vector;

import javax.swing.JButton;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.fjr.code.dao.TextoInteligenteDAO;
import com.fjr.code.dto.TextoInteligenteDTO;
import com.fjr.code.gui.SimpleTextEditorDialog;
import com.fjr.code.gui.tables.JTableButtonRenderer;

/**
 * 
 * Class: JTableTextoInteligente
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTableTextoInteligente implements JTablePanel{
	private static final String BTN_ABRIR_TEXT = "Abrir";
	private static final String BTN_USAR_TEXT = "Usar";
	
	private DefaultTableModel model;
	private JTable table;
	private static JTableTextoInteligente instance;
	private List<TextoInteligenteDTO> listado;
	private boolean showOpenButton;
	private SimpleTextEditorDialog ventanaReferencia;
	
	/**
	 * Si listado es distinto de null, se usa dicho listado
	 * sino, se usa el valor de la fase
	 * 
	 * @param faseABuscar
	 * @param listado
	 */
	private JTableTextoInteligente(List<TextoInteligenteDTO> listado) {
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
					//se desea abrir el registro de determinada biopsia
					//en su frame correspondiente
					if(showOpenButton){
						
					} else {
						//actualizamos la ventana de referencia
						if(ventanaReferencia != null){
							TextoInteligenteDTO texto = TextoInteligenteDAO.getByKeyCode(
									(String) table.getValueAt(table.getSelectedRow(), 1));
							ventanaReferencia.getTextCodigo().setText(texto.getKeyCode());
							ventanaReferencia.getTextAbreviatura().setText(texto.getAbreviatura());
							ventanaReferencia.getTxtArea().setText(
									ventanaReferencia.getTxtArea().getText() + texto.getTexto());
						}
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
	public static JTableTextoInteligente getNewInstance(List<TextoInteligenteDTO> listado){
		instance = getNewInstance(listado, true, null);
		
		return instance;
	}
	
	/**
	 * 
	 * @param listado
	 * @param showOpenButton
	 * @return
	 */
	public static JTableTextoInteligente getNewInstance(List<TextoInteligenteDTO> listado,
			boolean showOpenButton, SimpleTextEditorDialog ventanaReferencia){
		instance = new JTableTextoInteligente(listado);
		instance.showOpenButton = showOpenButton;
		instance.ventanaReferencia = ventanaReferencia;
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		model.addColumn("");
		model.addColumn("Codigo");
		model.addColumn("Descripcion");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(100);
		table.getColumnModel().getColumn(1).setPreferredWidth(100);
		table.getColumnModel().getColumn(2).setPreferredWidth(450);
		
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
		
		//indicamos que la primera columna tendra un renderizado de boton
		table.getColumnModel().getColumn(0).setCellRenderer(new JTableButtonRenderer());
		
		//buscamos los registros de biopsias activas para mostrarlos aqui
		if(listado != null){
			for (TextoInteligenteDTO textoDTO : listado) {
				addRow(textoDTO.getKeyCode(),
						textoDTO.getAbreviatura());
			}
		}
	}
	
	public JTable getJTable() {
		return table;
	}
	
	/**
	 * 
	 * @param keyCode
	 * @param abreviatura
	 */
	public void addRow(String keyCode, String abreviatura){
		Vector<Object> rowData = new Vector<Object>();
		if(showOpenButton){
			rowData.add(BTN_ABRIR_TEXT);
		}else{
			rowData.add(BTN_USAR_TEXT);
		}
		rowData.add(keyCode);
		rowData.add(abreviatura);
		
		model.addRow(rowData);
	}
	
	/**
	 * 
	 * @param row
	 * @param keyCode
	 * @param abreviatura
	 */
	public void updateRow(int row, String keyCode, String abreviatura){
		if(row > -1){
			model.setValueAt(keyCode, row, 1);
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
