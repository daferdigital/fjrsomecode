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

import javax.swing.JRadioButton;
import javax.swing.JSeparator;
import javax.swing.JCheckBox;
import javax.swing.JTextField;
import javax.swing.JPasswordField;

import com.fjr.code.dao.UsuarioDAO;
import com.fjr.code.dto.UsuarioDTO;

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
	private JTextField txtApellido;
	private JTextField txtLogin;
	private JPasswordField txtPassword;
	private int idUsuario;
	
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
		this.idUsuario = idUsuario;
		UsuarioDTO usuario = UsuarioDAO.getById(idUsuario);
		if(usuario == null){
			usuario = new UsuarioDTO();
		}
		
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
		
		JLabel lblNewLabel_1 = new JLabel("Nombre:");
		lblNewLabel_1.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblNewLabel_1.setBounds(10, 11, 74, 14);
		panelDatos.add(lblNewLabel_1);
		
		txtNombre = new JTextField(usuario.getNombre() == null ? "" : usuario.getNombre());
		txtNombre.setBounds(120, 11, 200, 20);
		txtNombre.setColumns(10);
		panelDatos.add(txtNombre);
		
		JLabel lblApellido = new JLabel("Apellido:");
		lblApellido.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblApellido.setBounds(10, 38, 74, 14);
		panelDatos.add(lblApellido);
		
		txtApellido = new JTextField();
		txtApellido.setColumns(10);
		txtApellido.setBounds(120, 38, 200, 20);
		panelDatos.add(txtApellido);
		
		JLabel lblLogin = new JLabel("Login/Usuario:");
		lblLogin.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblLogin.setBounds(10, 65, 114, 14);
		panelDatos.add(lblLogin);
		
		txtLogin = new JTextField();
		txtLogin.setColumns(10);
		txtLogin.setBounds(120, 65, 200, 20);
		panelDatos.add(txtLogin);
		
		JLabel lblClave = new JLabel("Clave:");
		lblClave.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblClave.setBounds(10, 92, 114, 14);
		panelDatos.add(lblClave);
		
		txtPassword = new JPasswordField();
		txtPassword.setBounds(120, 92, 200, 20);
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
		
		JRadioButton rbtnTodos = new JRadioButton("Todos");
		rbtnTodos.setBounds(41, 32, 109, 23);
		panelPermisos.add(rbtnTodos);
		
		JSeparator separator = new JSeparator();
		separator.setBounds(20, 62, 379, 2);
		panelPermisos.add(separator);
		
		JCheckBox chBoxEntrega = new JCheckBox("Entrega");
		chBoxEntrega.setBounds(10, 77, 97, 23);
		panelPermisos.add(chBoxEntrega);
		
		JCheckBox chBoxRecepcion = new JCheckBox("Recepci\u00F3n");
		chBoxRecepcion.setBounds(10, 103, 97, 23);
		panelPermisos.add(chBoxRecepcion);
		
		JCheckBox chBoxMacro = new JCheckBox("Macro");
		chBoxMacro.setBounds(10, 129, 97, 23);
		panelPermisos.add(chBoxMacro);
		
		JCheckBox chBoxHistologia = new JCheckBox("Histolog\u00EDa");
		chBoxHistologia.setBounds(10, 155, 97, 23);
		panelPermisos.add(chBoxHistologia);
		
		JCheckBox chBoxMicro = new JCheckBox("Micro");
		chBoxMicro.setBounds(10, 181, 97, 23);
		panelPermisos.add(chBoxMicro);
		
		JCheckBox chBoxIHQ = new JCheckBox("IHQ");
		chBoxIHQ.setBounds(10, 207, 97, 23);
		panelPermisos.add(chBoxIHQ);
		
		JCheckBox chBoxMaestros = new JCheckBox("Maestros");
		chBoxMaestros.setBounds(109, 77, 97, 23);
		panelPermisos.add(chBoxMaestros);
		
		JCheckBox chBoxBusquedas = new JCheckBox("B\u00FAsquedas");
		chBoxBusquedas.setBounds(109, 103, 97, 23);
		panelPermisos.add(chBoxBusquedas);
		
		contentPanel.add(tabPanel);
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("OK");
				okButton.setActionCommand("OK");
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
			{
				JButton cancelButton = new JButton("Cancel");
				cancelButton.setActionCommand("Cancel");
				buttonPane.add(cancelButton);
			}
		}
	}
}
