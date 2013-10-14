package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;

import com.fjr.code.dao.ReactivoDAO;
import com.fjr.code.dto.ReactivoDTO;
import com.fjr.code.gui.operations.ListenerDobleClickTextArea;
import com.fjr.code.gui.operations.MicroLaminasDialogOperations;
import com.fjr.code.gui.tables.JTableMicroLaminas;

import java.awt.Font;
import java.awt.Toolkit;

import javax.swing.JFileChooser;
import javax.swing.JLabel;
import javax.swing.JTextArea;
import javax.swing.JScrollPane;
import javax.swing.JComboBox;
import javax.swing.JList;
import javax.swing.border.LineBorder;
import java.awt.Color;
import java.util.Vector;

import javax.swing.ListSelectionModel;

/**
 * 
 * Class: MicroLaminasDialog
 * Creation Date: 15/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class MicroLaminasDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = -4897721956584641401L;
	private final JPanel contentPanel = new JPanel();
	private JTextArea textADescripcion;
	private JLabel lblProcedencia;
	private JComboBox cBoxReactivo;
	private JTableMicroLaminas relatedTable;
	private int rowOrigin;
	private JList listLaminasFiles;
	private JFileChooser fileChooser;
	private JLabel lblFilePreview;
	private String filesMicroPaths;
	Vector<String> listDataReactivos = new Vector<String>();
	Vector<Integer> listDataReactivosHidden = new Vector<Integer>();
	private JList listReactivosAsignados;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			MicroLaminasDialog dialog = new MicroLaminasDialog(null, 0, 0, "", "", "", "", "");
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * 
	 * @param relatedTable
	 * @param rowOrigin
	 * @param cassete
	 * @param bloque
	 * @param lamina
	 * @param descripcion
	 * @param idsReactivo
	 * @param filesMicroPaths
	 */
	public MicroLaminasDialog(JTableMicroLaminas relatedTable, int rowOrigin, int cassete, String bloque, 
			String lamina, String descripcion, String idsReactivo, String filesMicroPaths) {
		this.relatedTable = relatedTable;
		this.rowOrigin = rowOrigin;
		this.filesMicroPaths = filesMicroPaths;
		
		setTitle("Micro Laminas");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(MicroLaminasDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 656, 559);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		{
			JLabel lbl = new JLabel("Procedencia:");
			lbl.setFont(new Font("Tahoma", Font.BOLD, 13));
			lbl.setBounds(10, 11, 91, 14);
			contentPanel.add(lbl);
		}
		
		lblProcedencia = new JLabel("C" + cassete + " B" + bloque + " L" + lamina);
		lblProcedencia.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblProcedencia.setBounds(111, 12, 206, 14);
		contentPanel.add(lblProcedencia);
		
		JLabel lblReactivo = new JLabel("Reactivo:");
		lblReactivo.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblReactivo.setBounds(10, 36, 91, 14);
		contentPanel.add(lblReactivo);
		
		cBoxReactivo = new JComboBox();
		cBoxReactivo.setBounds(111, 34, 194, 23);
		ReactivoDAO.populateJCombo(cBoxReactivo, 0);
		
		contentPanel.add(cBoxReactivo);
		
		JButton btnAddReactivo = new JButton("<html><b>--&gt;&gt;</b></html>");
		btnAddReactivo.setFont(new Font("Tahoma", Font.PLAIN, 14));
		btnAddReactivo.setBounds(315, 36, 54, 23);
		btnAddReactivo.setActionCommand(MicroLaminasDialogOperations.ACTION_COMMAND_BTN_ADD_REACTIVO);
		contentPanel.add(btnAddReactivo);
		
		JButton btnDelReactivo = new JButton("<html><b>&lt;&lt;--</b></html>");
		btnDelReactivo.setFont(new Font("Tahoma", Font.PLAIN, 14));
		btnDelReactivo.setBounds(315, 70, 54, 23);
		btnDelReactivo.setActionCommand(MicroLaminasDialogOperations.ACTION_COMMAND_BTN_DEL_REACTIVO);
		contentPanel.add(btnDelReactivo);
		
		JScrollPane scrollPane_2 = new JScrollPane();
		scrollPane_2.setBounds(379, 11, 251, 106);
		contentPanel.add(scrollPane_2);
		
		listReactivosAsignados = new JList();
		listReactivosAsignados.setBorder(new LineBorder(new Color(0, 0, 0)));
		
		String[] pieces = idsReactivo.split(";");
		if(pieces != null && pieces.length > 0){
			for (String id : pieces) {
				//buscamos el item asociado al id
				for(int i = 0; i < cBoxReactivo.getItemCount(); i++){
					if(((ReactivoDTO) cBoxReactivo.getItemAt(i)).getId() == Integer.parseInt(id)){
						listDataReactivos.add(((ReactivoDTO) cBoxReactivo.getItemAt(i)).getNombre());
						listDataReactivosHidden.add(Integer.parseInt(id));
						break;
					}
				}
			}
		}
		listReactivosAsignados.setListData(listDataReactivos);
		
		
		scrollPane_2.setViewportView(listReactivosAsignados);
		{
			JLabel lbldescripcioacuten = new JLabel("<html>Descripci&oacute;n <br/>Micro fotograf&iacute;a:</html>");
			lbldescripcioacuten.setFont(new Font("Tahoma", Font.BOLD, 13));
			lbldescripcioacuten.setBounds(10, 124, 91, 56);
			contentPanel.add(lbldescripcioacuten);
		}
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(110, 125, 328, 119);
		contentPanel.add(scrollPane);
		
		textADescripcion = new JTextArea();
		textADescripcion.setBorder(new LineBorder(new Color(0, 0, 0)));
		textADescripcion.setLineWrap(true);
		textADescripcion.setWrapStyleWord(true);
		textADescripcion.setText(descripcion);
		textADescripcion.addMouseListener(new ListenerDobleClickTextArea(textADescripcion));
		scrollPane.setViewportView(textADescripcion);
		
		JButton btnAnexarArchivo = new JButton("Anexar Archivo");
		btnAnexarArchivo.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnAnexarArchivo.setBounds(10, 269, 124, 23);
		btnAnexarArchivo.setActionCommand(MicroLaminasDialogOperations.ACTION_COMMAND_BTN_SUBIR_FOTO);
		contentPanel.add(btnAnexarArchivo);
		
		JLabel lblNewLabel = new JLabel("<html>Puede seleccionar varios archivos como fotos o videos a la vez.</html>");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 11));
		lblNewLabel.setBounds(10, 300, 124, 64);
		contentPanel.add(lblNewLabel);
		
		JLabel lblArchivos = new JLabel("Archivos:");
		lblArchivos.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblArchivos.setBounds(171, 255, 83, 14);
		contentPanel.add(lblArchivos);
		
		JScrollPane scrollPane_1 = new JScrollPane();
		scrollPane_1.setBounds(144, 274, 225, 203);
		contentPanel.add(scrollPane_1);
		
		listLaminasFiles = new JList();
		listLaminasFiles.setSelectionMode(ListSelectionModel.SINGLE_SELECTION);
		listLaminasFiles.setName(MicroLaminasDialogOperations.NAME_LIST_FILES);
		scrollPane_1.setRowHeaderView(listLaminasFiles);
		
		lblFilePreview = new JLabel("");
		lblFilePreview.setToolTipText("Doble click para abrir el archivo con la aplicaci\u00F3n por defecto");
		lblFilePreview.setBorder(new LineBorder(new Color(0, 0, 0)));
		lblFilePreview.setBounds(402, 274, 194, 172);
		lblFilePreview.setName(MicroLaminasDialogOperations.ACTION_COMMAND_OPEN_FILE);
		contentPanel.add(lblFilePreview);
		
		JButton btnEliminarArchivo = new JButton("Eliminar Archivo");
		btnEliminarArchivo.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnEliminarArchivo.setBounds(442, 454, 124, 23);
		btnEliminarArchivo.setActionCommand(MicroLaminasDialogOperations.ACTION_COMMAND_BTN_DELETE_FOTO);
		contentPanel.add(btnEliminarArchivo);
		
		JPanel buttonPane = new JPanel();
		buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
		getContentPane().add(buttonPane, BorderLayout.SOUTH);
		
		JButton okButton = new JButton("Guardar");
		okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
		okButton.setActionCommand(MicroLaminasDialogOperations.ACTION_COMMAND_BTN_ACEPTAR);
		buttonPane.add(okButton);
		getRootPane().setDefaultButton(okButton);
		
		JButton cancelButton = new JButton("Cancelar");
		cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
		cancelButton.setActionCommand(MicroLaminasDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
		
		buttonPane.add(cancelButton);
		
		MicroLaminasDialogOperations listener = new MicroLaminasDialogOperations(this);
		okButton.addActionListener(listener);
		cancelButton.addActionListener(listener);
		btnAnexarArchivo.addActionListener(listener);
		btnEliminarArchivo.addActionListener(listener);
		btnAddReactivo.addActionListener(listener);
		btnDelReactivo.addActionListener(listener);
		listLaminasFiles.addListSelectionListener(listener);
		listReactivosAsignados.addListSelectionListener(listener);
		fileChooser = new JFileChooser();
		fileChooser.setMultiSelectionEnabled(true);
		
		setLocationRelativeTo(null);
	}
	
	/**
	 * 
	 * @return
	 */
	public JFileChooser getFileChooser() {
		return fileChooser;
	}
	
	/**
	 * 
	 * @return
	 */
	public JTableMicroLaminas getRelatedTable() {
		return relatedTable;
	}
	
	/**
	 * 
	 * @return
	 */
	public int getRowOrigin() {
		return rowOrigin;
	}
	
	/**
	 * 
	 * @return
	 */
	public JTextArea getTextADescripcion() {
		return textADescripcion;
	}
	
	/**
	 * 
	 * @return
	 */
	public JComboBox getcBoxReactivo() {
		return cBoxReactivo;
	}

	/**
	 * 
	 * @return
	 */
	public JLabel getLblFilePreview() {
		return lblFilePreview;
	}
	
	/**
	 * 
	 * @return
	 */
	public JList getListLaminasFiles() {
		return listLaminasFiles;
	}
	
	public JList getListReactivosAsignados() {
		return listReactivosAsignados;
	}
	
	public String getFilesMicroPaths() {
		return filesMicroPaths;
	}
	
	public Vector<String> getListDataReactivos() {
		return listDataReactivos;
	}
	
	public Vector<Integer> getListDataReactivosHidden() {
		return listDataReactivosHidden;
	}
}
