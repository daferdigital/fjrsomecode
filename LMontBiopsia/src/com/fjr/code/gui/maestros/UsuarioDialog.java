package com.fjr.code.gui.maestros;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.JTabbedPane;
import javax.swing.border.EmptyBorder;

import java.awt.Toolkit;

import javax.swing.JLabel;

import java.awt.Font;
import java.util.LinkedList;
import java.util.List;

import javax.swing.JRadioButton;
import javax.swing.JSeparator;
import javax.swing.JCheckBox;
import javax.swing.JTextField;
import javax.swing.JPasswordField;

import com.fjr.code.dao.UsuarioDAO;
import com.fjr.code.dao.definitions.ModulosSistema;
import com.fjr.code.dto.PermisosUsuarioDTO;
import com.fjr.code.dto.UsuarioDTO;
import com.fjr.code.gui.operations.maestros.UsuarioDialogOperations;

/**
 * 
 * Class: UsuarioDialog <br />
 * DateCreated: 08/01/2014 <br />
 * @author T&T <br />
 *
 */
public class UsuarioDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 1432436482481770849L;
	private final JPanel contentPanel = new JPanel();
	private final JTabbedPane tabPanel = new JTabbedPane();
	private JTextField txtNombre;
	private JTextField txtLogin;
	private JPasswordField txtPassword;
	private JCheckBox chBoxEntrega = new JCheckBox("Entrega");
	private JCheckBox chBoxRecepcion = new JCheckBox("Recepci\u00F3n");
	private JCheckBox chBoxMacro = new JCheckBox("Macro");
	private JCheckBox chBoxHistologia = new JCheckBox("Histolog\u00EDa");
	private JCheckBox chBoxMicro = new JCheckBox("Micro");
	private JCheckBox chBoxIHQ = new JCheckBox("IHQ");
	private JCheckBox chBoxMaestros = new JCheckBox("Maestros");
	private JCheckBox chBoxBusquedas = new JCheckBox("B\u00FAsquedas");
	private JCheckBox cBoxInformeComplementario = new JCheckBox("Informe Complementario");
	
	private int idUsuario;
	private JRadioButton rbtnAllPermissions;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			UsuarioDialog dialog = new UsuarioDialog(-1);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public UsuarioDialog(int idUsuario) {
		setModal(true);
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		this.idUsuario = idUsuario;
		UsuarioDTO usuario = UsuarioDAO.getById(idUsuario);
		
		setTitle("Maestro de Usuarios");
		setIconImage(Toolkit.getDefaultToolkit().getImage(UsuarioDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 381);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		contentPanel.setLayout(null);
		tabPanel.setBounds(10, 10, 414, 289);
		
		JPanel panelDatos = new JPanel();
		tabPanel.addTab("Datos Básicos", panelDatos);
		panelDatos.setLayout(null);
		
		JLabel lblNewLabel_1 = new JLabel("Nombre Completo:");
		lblNewLabel_1.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblNewLabel_1.setBounds(10, 21, 120, 14);
		panelDatos.add(lblNewLabel_1);
		
		txtNombre = new JTextField(usuario == null ? "" : usuario.getNombre());
		txtNombre.setBounds(130, 21, 200, 20);
		txtNombre.setColumns(10);
		panelDatos.add(txtNombre);
		
		JLabel lblLogin = new JLabel("Login/Usuario:");
		lblLogin.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblLogin.setBounds(10, 46, 114, 14);
		panelDatos.add(lblLogin);
		
		txtLogin = new JTextField(usuario == null ? "" : usuario.getLogin());
		txtLogin.setColumns(10);
		txtLogin.setBounds(130, 46, 200, 20);
		txtLogin.setEditable(usuario == null);
		panelDatos.add(txtLogin);
		
		JLabel lblClave = new JLabel("Clave:");
		lblClave.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblClave.setBounds(10, 71, 114, 14);
		panelDatos.add(lblClave);
		
		txtPassword = new JPasswordField();
		txtPassword.setBounds(130, 71, 200, 20);
		panelDatos.add(txtPassword);
		JPanel panelPermisos = new JPanel();
		tabPanel.addTab("Permisos", panelPermisos);
		panelPermisos.setLayout(null);
		{
			JLabel lblNewLabel = new JLabel("Permisos:");
			lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 12));
			lblNewLabel.setBounds(10, 11, 126, 14);
			panelPermisos.add(lblNewLabel);
		}
		
		rbtnAllPermissions = new JRadioButton("Todos");
		rbtnAllPermissions.setFont(new Font("Tahoma", Font.PLAIN, 12));
		rbtnAllPermissions.setBounds(41, 32, 109, 23);
		panelPermisos.add(rbtnAllPermissions);
		
		JSeparator separator = new JSeparator();
		separator.setBounds(20, 62, 379, 2);
		panelPermisos.add(separator);
		
		chBoxEntrega.setFont(new Font("Tahoma", Font.PLAIN, 12));
		chBoxEntrega.setBounds(10, 77, 97, 23);
		
		chBoxRecepcion.setFont(new Font("Tahoma", Font.PLAIN, 12));
		chBoxRecepcion.setBounds(10, 103, 97, 23);
		
		chBoxMacro.setFont(new Font("Tahoma", Font.PLAIN, 12));
		chBoxMacro.setBounds(10, 129, 97, 23);
		
		chBoxHistologia.setFont(new Font("Tahoma", Font.PLAIN, 12));
		chBoxHistologia.setBounds(10, 155, 97, 23);
		
		chBoxMicro.setFont(new Font("Tahoma", Font.PLAIN, 12));
		chBoxMicro.setBounds(10, 181, 97, 23);
		
		chBoxIHQ.setFont(new Font("Tahoma", Font.PLAIN, 12));
		chBoxIHQ.setBounds(10, 207, 97, 23);
		
		chBoxMaestros.setFont(new Font("Tahoma", Font.PLAIN, 12));
		chBoxMaestros.setBounds(109, 77, 97, 23);
		
		chBoxBusquedas.setFont(new Font("Tahoma", Font.PLAIN, 12));
		chBoxBusquedas.setBounds(109, 103, 97, 23);
		
		cBoxInformeComplementario.setFont(new Font("Tahoma", Font.PLAIN, 12));
		cBoxInformeComplementario.setBounds(109, 129, 168, 23);
		
		//validamos los posibles permisos
		if(usuario != null){
			for (PermisosUsuarioDTO permisos : usuario.getPermisos()) {
				if(ModulosSistema.ENTREGA.getKey().equals(permisos.getKeyModulo())){
					chBoxEntrega.setSelected(true);
				} else if(ModulosSistema.BUSQUEDA.getKey().equals(permisos.getKeyModulo())){
					chBoxBusquedas.setSelected(true);
				} else if(ModulosSistema.HISTOLOGIA.getKey().equals(permisos.getKeyModulo())){
					chBoxHistologia.setSelected(true);
				} else if(ModulosSistema.IHQ.getKey().equals(permisos.getKeyModulo())){
					chBoxIHQ.setSelected(true);
				} else if(ModulosSistema.INGRESO.getKey().equals(permisos.getKeyModulo())){
					chBoxRecepcion.setSelected(true);
				} else if(ModulosSistema.MACROSCOPICA.getKey().equals(permisos.getKeyModulo())){
					chBoxMacro.setSelected(true);
				} else if(ModulosSistema.MAESTROS.getKey().equals(permisos.getKeyModulo())){
					chBoxMaestros.setSelected(true);
				} else if(ModulosSistema.MICROSCOPICA.getKey().equals(permisos.getKeyModulo())){
					chBoxMicro.setSelected(true);
				} else if(ModulosSistema.INFORME_COMPLEMENTARIO.getKey().equals(permisos.getKeyModulo())){
					cBoxInformeComplementario.setSelected(true);
				}
			}
		}
		
		panelPermisos.add(chBoxEntrega);
		panelPermisos.add(chBoxRecepcion);
		panelPermisos.add(chBoxMacro);
		panelPermisos.add(chBoxHistologia);
		panelPermisos.add(chBoxMicro);
		panelPermisos.add(chBoxIHQ);
		panelPermisos.add(chBoxMaestros);
		panelPermisos.add(chBoxBusquedas);
		panelPermisos.add(cBoxInformeComplementario);
		
		contentPanel.add(tabPanel);
		UsuarioDialogOperations listener = new UsuarioDialogOperations(this);
		rbtnAllPermissions.setActionCommand(UsuarioDialogOperations.ACTION_COMMAND_MODIFY_PERMISSIONS);
		rbtnAllPermissions.addActionListener(listener);
		
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("Guardar");
				okButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				okButton.setActionCommand(UsuarioDialogOperations.ACTION_COMMAND_OK);
				okButton.addActionListener(listener);
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancelar");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(UsuarioDialogOperations.ACTION_COMMAND_CANCEL);
				cancelButton.addActionListener(listener);
				buttonPane.add(cancelButton);
			}
		}
		
		setLocationRelativeTo(null);
	}

	public int getIdUsuario() {
		return idUsuario;
	}

	public void setIdUsuario(int idUsuario) {
		this.idUsuario = idUsuario;
	}

	public JTextField getTxtNombre() {
		return txtNombre;
	}

	public JTextField getTxtLogin() {
		return txtLogin;
	}

	public JPasswordField getTxtPassword() {
		return txtPassword;
	}

	public JCheckBox getChBoxEntrega() {
		return chBoxEntrega;
	}

	public JCheckBox getChBoxRecepcion() {
		return chBoxRecepcion;
	}

	public JCheckBox getChBoxMacro() {
		return chBoxMacro;
	}

	public JCheckBox getChBoxHistologia() {
		return chBoxHistologia;
	}

	public JCheckBox getChBoxMicro() {
		return chBoxMicro;
	}

	public JCheckBox getChBoxIHQ() {
		return chBoxIHQ;
	}

	public JCheckBox getChBoxMaestros() {
		return chBoxMaestros;
	}

	public JCheckBox getChBoxBusquedas() {
		return chBoxBusquedas;
	}
	
	public JCheckBox getcBoxInformeComplementario() {
		return cBoxInformeComplementario;
	}
	
	public JRadioButton getRbtnAllPermissions() {
		return rbtnAllPermissions;
	}
	
	/**
	 * 
	 * @param value
	 */
	public void markAllPermissions(boolean value){
		chBoxEntrega.setSelected(value);
		chBoxRecepcion.setSelected(value);
		chBoxMacro.setSelected(value);
		chBoxHistologia.setSelected(value);
		chBoxMicro.setSelected(value);
		chBoxIHQ.setSelected(value);
		chBoxMaestros.setSelected(value);
		chBoxBusquedas.setSelected(value);
		cBoxInformeComplementario.setSelected(value);
	}
	
	/**
	 * Se obtiene el listado de los permisos actualmente marcados
	 * 
	 * @return
	 */
	public List<PermisosUsuarioDTO> getPermisosList(){
		List<PermisosUsuarioDTO> permisos = new LinkedList<PermisosUsuarioDTO>();
		
		if(chBoxBusquedas.isSelected()){
			permisos.add(new PermisosUsuarioDTO(ModulosSistema.BUSQUEDA.getKey()));
		}
		if(chBoxEntrega.isSelected()){
			permisos.add(new PermisosUsuarioDTO(ModulosSistema.ENTREGA.getKey()));
		}
		if(chBoxHistologia.isSelected()){
			permisos.add(new PermisosUsuarioDTO(ModulosSistema.HISTOLOGIA.getKey()));
		}
		if(chBoxIHQ.isSelected()){
			permisos.add(new PermisosUsuarioDTO(ModulosSistema.IHQ.getKey()));
		}
		if(chBoxRecepcion.isSelected()){
			permisos.add(new PermisosUsuarioDTO(ModulosSistema.INGRESO.getKey()));
		}
		if(chBoxMacro.isSelected()){
			permisos.add(new PermisosUsuarioDTO(ModulosSistema.MACROSCOPICA.getKey()));
		}
		if(chBoxMaestros.isSelected()){
			permisos.add(new PermisosUsuarioDTO(ModulosSistema.MAESTROS.getKey()));
		}
		if(chBoxMicro.isSelected()){
			permisos.add(new PermisosUsuarioDTO(ModulosSistema.MICROSCOPICA.getKey()));
		}
		if(cBoxInformeComplementario.isSelected()){
			permisos.add(new PermisosUsuarioDTO(ModulosSistema.INFORME_COMPLEMENTARIO.getKey()));
		}
		
		return permisos;
	}
}
