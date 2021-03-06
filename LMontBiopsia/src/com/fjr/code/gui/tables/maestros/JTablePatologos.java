package com.fjr.code.gui.tables.maestros;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.List;
import java.util.Vector;

import javax.swing.JButton;
import javax.swing.JOptionPane;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import com.fjr.code.dao.PatologoDAO;
import com.fjr.code.dto.PatologoDTO;
import com.fjr.code.gui.maestros.BusquedaPatologosPanel;
import com.fjr.code.gui.maestros.PatologoDialog;
import com.fjr.code.gui.tables.JTableButtonRenderer;

/**
 * 
 * Class: {@link JTablePatologos}
 * Creation Date: 10/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class JTablePatologos implements JTablePanel{
	
	private DefaultTableModel model;
	private JTable table;
	private static JTablePatologos instance;
	private List<PatologoDTO> listado;
	private final BusquedaPatologosPanel busquedaPatologosPanel;
	
	/**
	 * Si listado es distinto de null, se usa dicho listado
	 * sino, se usa el valor de la fase
	 * 
	 * @param listado
	 * @param busquedaUsuarioPanel
	 */
	private JTablePatologos(List<PatologoDTO> listado, final BusquedaPatologosPanel busquedaPatologosPanel) {
		// TODO Auto-generated constructor stub
		this.listado = listado;
		this.busquedaPatologosPanel = busquedaPatologosPanel;
		
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
				if((table.getSelectedColumn() == 0 || table.getSelectedColumn() == 1) && table.getSelectedRow() > -1){
					int idPatologo = (Integer) table.getValueAt(table.getSelectedRow(), 3);
					
					if(table.getSelectedColumn() == 0){
						//se desea abrir el registro del usuario correspondiente
						new PatologoDialog(idPatologo, busquedaPatologosPanel).setVisible(true);
					} else {
						//preguntamos si se esta seguro
						int respuesta = JOptionPane.showConfirmDialog(table,
								"Esta ud seguro de que desea eliminar al patologo " + table.getValueAt(table.getSelectedRow(), 2),
								"Esta Ud. seguro?",
								JOptionPane.YES_NO_OPTION);
						if(respuesta == JOptionPane.OK_OPTION){
							if(PatologoDAO.setActivePatologo(idPatologo, false)){
								busquedaPatologosPanel.reloadResults();
								JOptionPane.showMessageDialog(table, "El patologo " + table.getValueAt(table.getSelectedRow(), 2) + " fue eliminado.",
										"Patologo eliminado",
										JOptionPane.INFORMATION_MESSAGE);
							}
						}
					}
					e.consume();
				} 
				e.consume();
			}
		});
		
		model = (DefaultTableModel) table.getModel();
		buildTable();
	}
	
	/**
	 * 
	 * @param listado
	 * @param busquedaUsuarioPanel
	 * @return
	 */
	public static JTablePatologos getNewInstance(List<PatologoDTO> listado, BusquedaPatologosPanel busquedaPatologosPanel){
		instance = new JTablePatologos(listado, busquedaPatologosPanel);
		
		return instance;
	}
	
	/**
	 * Construimos la tabla
	 * 
	 */
	private void buildTable(){
		model.addColumn("");
		model.addColumn(" ");
		model.addColumn("Nombre Completo");
		model.addColumn("IdUsuario");
		
		table.getColumnModel().getColumn(0).setPreferredWidth(100);
		table.getColumnModel().getColumn(1).setPreferredWidth(100);
		table.getColumnModel().getColumn(2).setPreferredWidth(400);
		table.getColumnModel().removeColumn(table.getColumnModel().getColumn(3));
		
		table.setColumnSelectionAllowed(false);
		table.setRowSelectionAllowed(false);
		table.setCellSelectionEnabled(false);
		
		//indicamos que la primera columna tendra un renderizado de boton
		table.getColumnModel().getColumn(0).setCellRenderer(new JTableButtonRenderer());
		table.getColumnModel().getColumn(1).setCellRenderer(new JTableButtonRenderer());
		
		//buscamos los registros de biopsias activas para mostrarlos aqui
		for (PatologoDTO patologoDTO : listado) {
			addRow(patologoDTO.getId(),
					patologoDTO.getNombre());
		}
	}
	
	public JTable getJTable() {
		return table;
	}
	
	/**
	 * 
	 * @param idUsuario
	 * @param nombre
	 */
	public void addRow(int idUsuario, String nombre){
		Vector<Object> rowData = new Vector<Object>();
		rowData.add("Abrir");
		rowData.add("Eliminar");
		rowData.add(nombre);
		rowData.add(idUsuario);
		
		model.addRow(rowData);
	}
	
	/**
	 * 
	 * @param row
	 * @param nombre
	 * @param abreviatura
	 */
	public void updateRow(int row, String nombre){
		if(row > -1){
			model.setValueAt(nombre, row, 1);
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
