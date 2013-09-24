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

import com.fjr.code.dto.ReactivoDTO;
import com.fjr.code.gui.MicroLaminasDialog;

/**
 * 
 * Class: MicroLaminasDialogOperations
 * Creation Date: 15/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class MicroLaminasDialogOperations implements ActionListener, ListSelectionListener, MouseListener{
	public static final String ACTION_COMMAND_BTN_ADD_REACTIVO = "btnAddReactivo";
	public static final String ACTION_COMMAND_BTN_DEL_REACTIVO = "btnDelReactivo";
	public static final String ACTION_COMMAND_BTN_SUBIR_FOTO = "btnSubirFoto";
	public static final String ACTION_COMMAND_BTN_DELETE_FOTO = "btnDeleteFoto";
	public static final String ACTION_COMMAND_BTN_ACEPTAR = "btnAceptar";
	public static final String ACTION_COMMAND_BTN_CANCELAR = "btnCancelar";
	public static final String ACTION_COMMAND_OPEN_FILE = "openFile";
	
	private MicroLaminasDialog ventana;
	private String fileToOpen;
	private Vector<File> listFilesDataHidden = new Vector<File>();
	private Vector<String> listFilesData = new Vector<String>();
	private Vector<Integer> listReactivosDataHidden = new Vector<Integer>(0);
	private Vector<String> listReactivosData = new Vector<String>(0);
	
	/**
	 * 
	 * @param ventana
	 */
	public MicroLaminasDialogOperations(MicroLaminasDialog ventana) {
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
				
				String listadoReactivos = null;
				String idsReactivos = null;
				//vaciamos la informacion de los reactivos
				if(! listReactivosData.isEmpty()){
					for (int i = 0; i < listReactivosData.size(); i++) {
						if(listadoReactivos != null){
							listadoReactivos += ";";
							idsReactivos += ";";
						} else {
							listadoReactivos = "";
							idsReactivos = "";
						}
						
						listadoReactivos += listReactivosData.get(i);
						idsReactivos += listReactivosDataHidden.get(i);
					}
				} else {
					listadoReactivos = "";
					idsReactivos = "-1";
				}
				
				ventana.getRelatedTable().updateRow(ventana.getRowOrigin(), 
						ventana.getTextADescripcion().getText(), 
						listadoReactivos,
						idsReactivos,
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
		} else if (ACTION_COMMAND_BTN_ADD_REACTIVO.equals(e.getActionCommand())){
			//tomamos la lista de reactivos y vemos si se marco alguno
			//en ese caso lo agregamos solo si no estaba ya antes
			int idReactivo = -2;
			if(ventana.getcBoxReactivo().getSelectedIndex() > 0){
				ReactivoDTO reactivo = (ReactivoDTO) ventana.getcBoxReactivo().getSelectedItem();
				idReactivo = reactivo.getId();
				
				if(! listReactivosDataHidden.contains(idReactivo)){
					//debo agregar del reactivo
					listReactivosDataHidden.add(idReactivo);
					listReactivosData.add(reactivo.getNombre());
					
					listReactivosDataHidden.trimToSize();
					listReactivosData.trimToSize();
					
					ventana.getListReactivosAsignados().setListData(listReactivosData);
				}
			}
		} else if (ACTION_COMMAND_BTN_DEL_REACTIVO.equals(e.getActionCommand())){
			//tomamos la lista de reactivos y eliminamos el seleccionado si es que hay alguno marcado
			int selectedIndex = ventana.getListReactivosAsignados().getSelectedIndex();
			if(selectedIndex > -1){
				listReactivosDataHidden.remove(selectedIndex);
				listReactivosData.remove(selectedIndex);
				
				listReactivosDataHidden.trimToSize();
				listReactivosData.trimToSize();
				
				ventana.getListReactivosAsignados().setListData(listReactivosData);
			}
		}
	}

	@Override
	public void valueChanged(ListSelectionEvent e) {
		// TODO Auto-generated method stub
		if(e.getValueIsAdjusting()){
			JList list = (JList) e.getSource();
			if(list.getSelectedIndex() > -1){
				putFileContentInLabel(listFilesDataHidden.get(list.getSelectedIndex()).getAbsolutePath());
			} else {
				fileToOpen = null;
				ventana.getLblFilePreview().setIcon(null);
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
