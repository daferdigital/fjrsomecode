package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import java.awt.Font;
import java.util.List;

import javax.swing.JLabel;
import javax.swing.JComboBox;

import com.fjr.code.dao.DiagnosticoWizardDAO;
import com.fjr.code.dao.PatologoDAO;
import com.fjr.code.dto.DiagnosticoWizardDTO;
import com.fjr.code.gui.operations.PrepareDiagnosticoDialogOperations;

/**
 * 
 * Class: PrepareDiagnosticoDialog
 * Creation Date: 12/10/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class PrepareDiagnosticoDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = -9130523348387201816L;
	private final JPanel contentPanel = new JPanel();
	private String codigoBiopsia;
	private JComboBox cBoxFirmante1;
	private JComboBox cBoxFirmante2;
	private JButton btnMarkAsPrint;
	private JButton btnVisualizar;
	private List<DiagnosticoWizardDTO> wizardPrevio;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			PrepareDiagnosticoDialog dialog = new PrepareDiagnosticoDialog(null);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * 
	 * @param codigoBiopsia
	 */
	public PrepareDiagnosticoDialog(String codigoBiopsia) {
		this.codigoBiopsia = codigoBiopsia;
		wizardPrevio = DiagnosticoWizardDAO.getWizardPrevio(codigoBiopsia);
		
		setTitle("Indique los valores para el diagnostico '" + codigoBiopsia + "'");
		setModal(true);
		setIconImage(Toolkit.getDefaultToolkit().getImage(PrepareDiagnosticoDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 450, 300);
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
		PatologoDAO.populateJCombo(cBoxFirmante1,
				false,
				wizardPrevio != null ? wizardPrevio.get(0).getIdFirmante1() : -1);
		contentPanel.add(cBoxFirmante1);
		
		cBoxFirmante2 = new JComboBox();
		cBoxFirmante2.setBounds(92, 34, 249, 20);
		PatologoDAO.populateJCombo(cBoxFirmante2,
				true,
				wizardPrevio != null ? wizardPrevio.get(0).getIdFirmante2() : -1);
		contentPanel.add(cBoxFirmante2);
		
		PrepareDiagnosticoDialogOperations listener = new PrepareDiagnosticoDialogOperations(this);
		
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				btnMarkAsPrint = new JButton("Marcar Como Impreso");
				btnMarkAsPrint.setVisible(false);
				btnMarkAsPrint.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnMarkAsPrint.addActionListener(listener);
				btnMarkAsPrint.setActionCommand(PrepareDiagnosticoDialogOperations.ACTION_COMMAND_BTN_MARCAR_COMO_IMPRESO);
				buttonPane.add(btnMarkAsPrint);
			}
			{
				btnVisualizar = new JButton("Visualizar");
				btnVisualizar.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnVisualizar.addActionListener(listener);
				btnVisualizar.setActionCommand(PrepareDiagnosticoDialogOperations.ACTION_COMMAND_BTN_VISUALIZAR);
				buttonPane.add(btnVisualizar);
				getRootPane().setDefaultButton(btnVisualizar);
			}
			{
				JButton btnCancel = new JButton("Cancel");
				btnCancel.setFont(new Font("Tahoma", Font.PLAIN, 12));
				btnCancel.addActionListener(listener);
				btnCancel.setActionCommand(PrepareDiagnosticoDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
				buttonPane.add(btnCancel);
			}
		}
		
		setLocationRelativeTo(null);
	}
	
	public String getCodigoBiopsia() {
		return codigoBiopsia;
	}
	
	public JComboBox getcBoxFirmante1() {
		return cBoxFirmante1;
	}
	
	public JComboBox getcBoxFirmante2() {
		return cBoxFirmante2;
	}
	
	public JButton getBtnMarkAsPrint() {
		return btnMarkAsPrint;
	}
	
	public JButton getBtnVisualizar() {
		return btnVisualizar;
	}
	
	public List<DiagnosticoWizardDTO> getWizardPrevio() {
		return wizardPrevio;
	}
}
