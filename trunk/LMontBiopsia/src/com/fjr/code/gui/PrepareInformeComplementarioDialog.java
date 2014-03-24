package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import java.awt.Font;
import javax.swing.JLabel;
import javax.swing.JComboBox;

import com.fjr.code.dao.PatologoDAO;
import com.fjr.code.gui.operations.ListenerDobleClickTextArea;
import com.fjr.code.gui.operations.PrepareInformeComplementarioDialogOperations;
import javax.swing.JTextArea;
import javax.swing.JScrollPane;

/**
 * 
 * Class: PrepareInformeComplementarioDialog <br />
 * DateCreated: 19/03/2014 <br />
 * @author T&T <br />
 *
 */
public class PrepareInformeComplementarioDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = -9130523348387201816L;
	private final JPanel contentPanel = new JPanel();
	private int idBiopsia;
	private JComboBox cBoxFirmante1;
	private JComboBox cBoxFirmante2;
	private JButton btnMarkAsPrint;
	private JButton btnVisualizar;
	private JTextArea txtAComentarios;
	private JTextArea txtADiagnostico;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			PrepareInformeComplementarioDialog dialog = new PrepareInformeComplementarioDialog(0);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * 
	 * @param idBiopsia
	 */
	public PrepareInformeComplementarioDialog(int idBiopsia) {
		this.idBiopsia = idBiopsia;
		
		setTitle("Indique los valores para el diagnostico complementario");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(PrepareInformeComplementarioDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 454);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblFirmante = new JLabel("Firmante 1:");
		lblFirmante.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblFirmante.setBounds(10, 11, 83, 14);
		contentPanel.add(lblFirmante);
		
		JLabel lblFirmante_1 = new JLabel("Firmante 2:");
		lblFirmante_1.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblFirmante_1.setBounds(10, 36, 83, 14);
		contentPanel.add(lblFirmante_1);
		
		cBoxFirmante1 = new JComboBox();
		cBoxFirmante1.setBounds(92, 9, 249, 20);
		PatologoDAO.populateJCombo(cBoxFirmante1, false);
		contentPanel.add(cBoxFirmante1);
		
		cBoxFirmante2 = new JComboBox();
		cBoxFirmante2.setBounds(92, 34, 249, 20);
		PatologoDAO.populateJCombo(cBoxFirmante2);
		contentPanel.add(cBoxFirmante2);
		
		JLabel lblComentarios = new JLabel("Comentarios:");
		lblComentarios.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblComentarios.setBounds(10, 86, 90, 14);
		contentPanel.add(lblComentarios);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(106, 82, 318, 138);
		contentPanel.add(scrollPane);
		
		txtAComentarios = new JTextArea();
		txtAComentarios.setWrapStyleWord(true);
		txtAComentarios.setLineWrap(true);
		txtAComentarios.addMouseListener(new ListenerDobleClickTextArea(txtAComentarios));
		scrollPane.setViewportView(txtAComentarios);
		
		JLabel lblDiagnostico = new JLabel("Diagnostico:");
		lblDiagnostico.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblDiagnostico.setBounds(10, 235, 90, 20);
		contentPanel.add(lblDiagnostico);
		
		JScrollPane scrollPane_1 = new JScrollPane();
		scrollPane_1.setBounds(107, 232, 316, 136);
		contentPanel.add(scrollPane_1);
		
		txtADiagnostico = new JTextArea();
		txtADiagnostico.setWrapStyleWord(true);
		txtADiagnostico.setLineWrap(true);
		txtADiagnostico.addMouseListener(new ListenerDobleClickTextArea(txtADiagnostico));
		scrollPane_1.setViewportView(txtADiagnostico);
		
		PrepareInformeComplementarioDialogOperations listener = new PrepareInformeComplementarioDialogOperations(this);
		
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				btnMarkAsPrint = new JButton("Marcar Como Impreso");
				btnMarkAsPrint.setVisible(false);
				btnMarkAsPrint.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnMarkAsPrint.addActionListener(listener);
				btnMarkAsPrint.setActionCommand(PrepareInformeComplementarioDialogOperations.ACTION_COMMAND_BTN_MARCAR_COMO_IMPRESO);
				buttonPane.add(btnMarkAsPrint);
			}
			{
				btnVisualizar = new JButton("Visualizar");
				btnVisualizar.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnVisualizar.addActionListener(listener);
				btnVisualizar.setActionCommand(PrepareInformeComplementarioDialogOperations.ACTION_COMMAND_BTN_VISUALIZAR);
				buttonPane.add(btnVisualizar);
				getRootPane().setDefaultButton(btnVisualizar);
			}
			{
				JButton btnCancel = new JButton("Cancel");
				btnCancel.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnCancel.addActionListener(listener);
				btnCancel.setActionCommand(PrepareInformeComplementarioDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
				buttonPane.add(btnCancel);
			}
		}
		
		setLocationRelativeTo(null);
	}
	
	public int getIdBiopsia() {
		return idBiopsia;
	}
	
	public JComboBox getcBoxFirmante1() {
		return cBoxFirmante1;
	}
	
	public JComboBox getcBoxFirmante2() {
		return cBoxFirmante2;
	}
	
	public JTextArea getTxtAComentarios() {
		return txtAComentarios;
	}
	
	public JTextArea getTxtADiagnostico() {
		return txtADiagnostico;
	}
	
	public JButton getBtnMarkAsPrint() {
		return btnMarkAsPrint;
	}
	
	public JButton getBtnVisualizar() {
		return btnVisualizar;
	}
}
