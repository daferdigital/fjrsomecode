package com.fjr.code.gui.operations;

import java.awt.Desktop;
import java.awt.Image;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseListener;
import java.io.File;
import java.io.IOException;
import java.util.Vector;

import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JFileChooser;
import javax.swing.JLabel;
import javax.swing.JList;
import javax.swing.event.ListSelectionEvent;
import javax.swing.event.ListSelectionListener;

import com.fjr.code.gui.MicroLaminasIHQDialog;

/**
 * 
 * Class: MicroLaminasDialogOperations
 * Creation Date: 15/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class MicroLaminasDialogIHQOperations implements ActionListener, ListSelectionListener, MouseListener{
	public static final String ACTION_COMMAND_BTN_SUBIR_FOTO = "btnSubirFoto";
	public static final String ACTION_COMMAND_BTN_DELETE_FOTO = "btnDeleteFoto";
	public static final String ACTION_COMMAND_BTN_ACEPTAR = "btnAceptar";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	public static final String ACTION_COMMAND_OPEN_FILE = "openFile";
	public static final String NAME_LIST_FILES = "nameListFiles";
	
	private MicroLaminasIHQDialog ventana;
	private String fileToOpen;
	private Vector<File> listFilesDataHidden = new Vector<File>();
	private Vector<String> listFilesData = new Vector<String>();
	
	/**
	 * 
	 * @param ventana
	 */
	public MicroLaminasDialogIHQOperations(MicroLaminasIHQDialog ventana) {
		// TODO Auto-generated constructor stub
		this.ventana = ventana;
		if(ventana.getFilesMicroPaths() != null && !"".equals(ventana.getFilesMicroPaths())){
			String[] pieces = ventana.getFilesMicroPaths().split(";");
			
			for (String filePath : pieces) {
				File f = new File(filePath);
				listFilesDataHidden.add(f);
				listFilesData.add(f.getName());
			}
			
			listFilesData.trimToSize();
			listFilesDataHidden.trimToSize();
			ventana.getListLaminasFiles().setListData(listFilesData);
		}
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BTN_SUBIR_FOTO.equals(e.getActionCommand())){
			//debemos subir la foto
			if(JFileChooser.APPROVE_OPTION == ventana.getFileChooser().showOpenDialog(ventana)){
				String fileName = ventana.getFileChooser().getSelectedFile().getAbsolutePath();
				
				putFileContentInLabel(fileName);
				
				listFilesDataHidden.add(ventana.getFileChooser().getSelectedFile());
				listFilesData.add(ventana.getFileChooser().getSelectedFile().getName());
				ventana.getListLaminasFiles().setListData(listFilesData);			
			}
		} else if (ACTION_COMMAND_BTN_ACEPTAR.equals(e.getActionCommand())
				|| ACTION_COMMAND_BTN_CANCELAR.equals(e.getActionCommand())){
			
			if (ACTION_COMMAND_BTN_ACEPTAR.equals(e.getActionCommand())){
				//debemos guardar
				//verificamos si se tienen fotos
				//verificamos la descripcion
				//verificamos el reactivo
				String filesItems = "";
				for (int i = 0; i < listFilesDataHidden.size(); i++) {
					if("".equals(filesItems)){
						filesItems += listFilesDataHidden.elementAt(i).getAbsolutePath();
					} else {
						filesItems += ";" + listFilesDataHidden.elementAt(i).getAbsolutePath();
					}
				}
				
				ventana.getRelatedTable().updateRow(ventana.getRowOrigin(), 
						ventana.getTextADescripcion().getText(), 
						filesItems);
			}
			
			ventana.dispose();
		} else if (ACTION_COMMAND_BTN_DELETE_FOTO.equals(e.getActionCommand())){
			//tomamos la lista y sacamos el archivo seleccionado
			int selectedIndex = ventana.getListLaminasFiles().getSelectedIndex();
			if(selectedIndex > -1){
				listFilesDataHidden.remove(selectedIndex);
				listFilesData.remove(selectedIndex);
				
				listFilesDataHidden.trimToSize();
				listFilesData.trimToSize();
				
				ventana.getListLaminasFiles().setListData(listFilesData);
			}
		}
	}

	@Override
	public void valueChanged(ListSelectionEvent e) {
		// TODO Auto-generated method stub
		if(e.getValueIsAdjusting()){
			JList list = (JList) e.getSource();
			if(NAME_LIST_FILES.equals(list.getName())){
				if(list.getSelectedIndex() > -1){
					putFileContentInLabel(listFilesDataHidden.get(list.getSelectedIndex()).getAbsolutePath());
				} else {
					fileToOpen = null;
					ventana.getLblFilePreview().setIcon(null);
				}
			}	
		}
	}
	
	/**
	 * @param fileName 
	 * 
	 */
	private void putFileContentInLabel(String fileName){
		Icon icon = new ImageIcon(new ImageIcon(fileName).getImage().getScaledInstance(ventana.getLblFilePreview().getWidth(),
				ventana.getLblFilePreview().getHeight(),
				Image.SCALE_AREA_AVERAGING));
		//debo colocarla como icono en la etiqueta respectiva
		fileToOpen = fileName;
		ventana.getLblFilePreview().setIcon(icon);
	}

	@Override
	public void mouseClicked(java.awt.event.MouseEvent e) {
		// TODO Auto-generated method stub
		if(e.getSource() instanceof JLabel){
			if(ACTION_COMMAND_OPEN_FILE.equals(((JLabel) e.getSource()).getName())){
				if(e.getClickCount() == 2){
					if(fileToOpen != null){
						try {
							Desktop.getDesktop().open(new File(fileToOpen));
						} catch (IOException e1) {
							// TODO Auto-generated catch block
							//e1.printStackTrace();
						}
					}
					e.consume();
				}
			}
		}
	}

	@Override
	public void mousePressed(java.awt.event.MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mouseReleased(java.awt.event.MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mouseEntered(java.awt.event.MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mouseExited(java.awt.event.MouseEvent e) {
		// TODO Auto-generated method stub
		
	}
}
