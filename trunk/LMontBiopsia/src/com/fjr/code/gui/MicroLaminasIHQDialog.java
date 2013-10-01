package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;

import com.fjr.code.gui.operations.MicroLaminasDialogIHQOperations;
import com.fjr.code.gui.tables.JTableMicroLaminasIHQ;

import java.awt.Font;
import java.awt.Toolkit;

import javax.swing.JFileChooser;
import javax.swing.JLabel;
import javax.swing.JTextArea;
import javax.swing.JScrollPane;
import javax.swing.JList;
import javax.swing.border.LineBorder;
import java.awt.Color;
import java.util.Vector;

import javax.swing.ListSelectionModel;

/**
 * 
 * Class: MicroLaminasIHQDialog
 * Creation Date: 15/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class MicroLaminasIHQDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = -4897721956584641401L;
	private final JPanel contentPanel = new JPanel();
	private JTextArea textADescripcion;
	private JLabel lblProcedencia;
	private JTableMicroLaminasIHQ relatedTable;
	private int rowOrigin;
	private JList listLaminasFiles;
	private JFileChooser fileChooser;
	private JLabel lblFilePreview;
	private String filesMicroPaths;
	Vector<String> listDataReactivos = new Vector<String>();
	Vector<Integer> listDataReactivosHidden = new Vector<Integer>();
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			MicroLaminasIHQDialog dialog = new MicroLaminasIHQDialog(null, 0, 0, "", "", "", "", "");
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
	public MicroLaminasIHQDialog(JTableMicroLaminasIHQ relatedTable, int rowOrigin, int cassete, String bloque, 
			String lamina, String descripcion, String nombreReactivo, String filesMicroPaths) {
		this.relatedTable = relatedTable;
		this.rowOrigin = rowOrigin;
		this.filesMicroPaths = filesMicroPaths;
		
		setTitle("Micro Laminas IHQ");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(MicroLaminasIHQDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 656, 498);
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
		
		JLabel lblReactivo = new JLabel("Reactivo a Aplicar: " + nombreReactivo);
		lblReactivo.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblReactivo.setBounds(10, 36, 556, 14);
		contentPanel.add(lblReactivo);
		
		JLabel lbldescripcioacuten = new JLabel("<html>Descripci&oacute;n:</html>");
		lbldescripcioacuten.setFont(new Font("Tahoma", Font.BOLD, 13));
		lbldescripcioacuten.setBounds(10, 61, 91, 14);
		contentPanel.add(lbldescripcioacuten);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(110, 62, 328, 119);
		contentPanel.add(scrollPane);
		
		textADescripcion = new JTextArea();
		textADescripcion.setBorder(new LineBorder(new Color(0, 0, 0)));
		textADescripcion.setLineWrap(true);
		textADescripcion.setWrapStyleWord(true);
		textADescripcion.setText(descripcion);
		scrollPane.setViewportView(textADescripcion);
		
		JButton btnAnexarArchivo = new JButton("Anexar Archivo");
		btnAnexarArchivo.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnAnexarArchivo.setBounds(10, 206, 124, 23);
		btnAnexarArchivo.setActionCommand(MicroLaminasDialogIHQOperations.ACTION_COMMAND_BTN_SUBIR_FOTO);
		contentPanel.add(btnAnexarArchivo);
		
		JLabel lblNewLabel = new JLabel("<html>Puede seleccionar varios archivos como fotos o videos a la vez.</html>");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 11));
		lblNewLabel.setBounds(10, 237, 124, 64);
		contentPanel.add(lblNewLabel);
		
		JLabel lblArchivos = new JLabel("Archivos:");
		lblArchivos.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblArchivos.setBounds(171, 192, 83, 14);
		contentPanel.add(lblArchivos);
		
		JScrollPane scrollPane_1 = new JScrollPane();
		scrollPane_1.setBounds(144, 211, 225, 203);
		contentPanel.add(scrollPane_1);
		
		listLaminasFiles = new JList();
		listLaminasFiles.setSelectionMode(ListSelectionModel.SINGLE_SELECTION);
		listLaminasFiles.setName(MicroLaminasDialogIHQOperations.NAME_LIST_FILES);
		scrollPane_1.setRowHeaderView(listLaminasFiles);
		
		lblFilePreview = new JLabel("");
		lblFilePreview.setToolTipText("Doble click para abrir el archivo con la aplicaci\u00F3n por defecto");
		lblFilePreview.setBorder(new LineBorder(new Color(0, 0, 0)));
		lblFilePreview.setBounds(402, 211, 194, 172);
		lblFilePreview.setName(MicroLaminasDialogIHQOperations.ACTION_COMMAND_OPEN_FILE);
		contentPanel.add(lblFilePreview);
		
		JButton btnEliminarArchivo = new JButton("Eliminar Archivo");
		btnEliminarArchivo.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnEliminarArchivo.setBounds(442, 391, 124, 23);
		btnEliminarArchivo.setActionCommand(MicroLaminasDialogIHQOperations.ACTION_COMMAND_BTN_DELETE_FOTO);
		contentPanel.add(btnEliminarArchivo);
		
		JPanel buttonPane = new JPanel();
		buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
		getContentPane().add(buttonPane, BorderLayout.SOUTH);
		
		JButton okButton = new JButton("Guardar");
		okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
		okButton.setActionCommand(MicroLaminasDialogIHQOperations.ACTION_COMMAND_BTN_ACEPTAR);
		buttonPane.add(okButton);
		getRootPane().setDefaultButton(okButton);
		
		JButton cancelButton = new JButton("Cancelar");
		cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
		cancelButton.setActionCommand(MicroLaminasDialogIHQOperations.ACTION_COMMAND_BTN_CANCELAR);
		
		buttonPane.add(cancelButton);
		
		MicroLaminasDialogIHQOperations listener = new MicroLaminasDialogIHQOperations(this);
		okButton.addActionListener(listener);
		cancelButton.addActionListener(listener);
		btnAnexarArchivo.addActionListener(listener);
		btnEliminarArchivo.addActionListener(listener);
		listLaminasFiles.addListSelectionListener(listener);
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
	public JTableMicroLaminasIHQ getRelatedTable() {
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
	
	public String getFilesMicroPaths() {
		return filesMicroPaths;
	}
}
