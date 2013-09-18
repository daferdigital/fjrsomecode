package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;

import com.fjr.code.gui.operations.HistologiaCasseteDialogOperations;
import com.fjr.code.gui.tables.JTableHistologia;

import java.awt.Toolkit;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.JComboBox;

public class HistologiaCasseteDialog extends JDialog {

	/**
	 * 
	 */
	private static final long serialVersionUID = 2445930092608761918L;
	private final JPanel contentPanel = new JPanel();
	private JTableHistologia relatedTable;
	private int rowOrigin = -1;
	private JLabel lblNumeroCassete;
	private JComboBox cBoxNumBloques;
	private JComboBox cBoxNumLaminas;
	private JTextArea textADescCassete;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			HistologiaCasseteDialog dialog = new HistologiaCasseteDialog(null, 0, 0, "", 0, 0);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
	/**
	 * Create the dialog.
	 * @param numero 
	 * @param descripcion 
	 * @param table 
	 */
	public HistologiaCasseteDialog(JTableHistologia relatedTable, int rowOrigin, int numero,
			String descripcion, int bloques, int laminas) {
		this.relatedTable = relatedTable;
		this.rowOrigin = rowOrigin;
		
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setIconImage(Toolkit.getDefaultToolkit().getImage(HistologiaCasseteDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setTitle("Edici\u00F3n de Cassete, Fase: Histolog\u00EDa");
		setModal(true);
		setBounds(100, 100, 450, 360);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		JLabel lblNewLabel = new JLabel("<html><b>N&uacute;mero de Cassete: <b/></html>");
		lblNewLabel.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel.setBounds(10, 11, 140, 14);
		contentPanel.add(lblNewLabel);
		
		lblNumeroCassete = new JLabel(Integer.toString(numero));
		lblNumeroCassete.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblNumeroCassete.setBounds(160, 12, 81, 14);
		contentPanel.add(lblNumeroCassete);
		
		JLabel lblnuacutemeroDeBloques = new JLabel("<html><b>N&uacute;mero de Bloques: <b/></html>");
		lblnuacutemeroDeBloques.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblnuacutemeroDeBloques.setBounds(10, 36, 140, 14);
		contentPanel.add(lblnuacutemeroDeBloques);
		
		cBoxNumBloques = new JComboBox();
		cBoxNumBloques.setFont(new Font("Tahoma", Font.PLAIN, 13));
		cBoxNumBloques.setBounds(151, 34, 100, 20);
		for (int i = 1; i < 101; i++) {
			cBoxNumBloques.addItem(i);
			if(bloques == i){
				cBoxNumBloques.setSelectedIndex(i - 1);
			}
		}
		contentPanel.add(cBoxNumBloques);
		
		JLabel lblnuacutemeroDeLaminas = new JLabel("<html><b>N&uacute;mero de Laminas: <b/></html>");
		lblnuacutemeroDeLaminas.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblnuacutemeroDeLaminas.setBounds(10, 61, 140, 14);
		contentPanel.add(lblnuacutemeroDeLaminas);
		
		cBoxNumLaminas = new JComboBox();
		cBoxNumLaminas.setFont(new Font("Tahoma", Font.PLAIN, 13));
		cBoxNumLaminas.setBounds(151, 61, 100, 20);
		for (int i = 1; i < 101; i++) {
			cBoxNumLaminas.addItem(i);
			if(laminas == i){
				cBoxNumLaminas.setSelectedIndex(i - 1);
			}
		}
		contentPanel.add(cBoxNumLaminas);
		
		JLabel lbldescripcioacuten = new JLabel("<html><b>Descripci&oacute;n: <b/></html>");
		lbldescripcioacuten.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lbldescripcioacuten.setBounds(10, 86, 140, 14);
		contentPanel.add(lbldescripcioacuten);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(109, 86, 300, 190);
		contentPanel.add(scrollPane);
		
		textADescCassete = new JTextArea();
		textADescCassete.setEditable(false);
		textADescCassete.setWrapStyleWord(true);
		textADescCassete.setLineWrap(true);
		textADescCassete.setText(descripcion);
		
		scrollPane.setViewportView(textADescCassete);
		
		JPanel buttonPane = new JPanel();
		buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
		getContentPane().add(buttonPane, BorderLayout.SOUTH);
		
		JButton okButton = new JButton("Guardar");
		okButton.setActionCommand(HistologiaCasseteDialogOperations.ACTION_COMMAND_BTN_ACEPTAR);
		buttonPane.add(okButton);
		getRootPane().setDefaultButton(okButton);
	
		JButton cancelButton = new JButton("Cancelar");
		cancelButton.setActionCommand(HistologiaCasseteDialogOperations.ACTION_COMMAND_BTN_CANCELAR);
		buttonPane.add(cancelButton);
		
		HistologiaCasseteDialogOperations listener = new HistologiaCasseteDialogOperations(this);
		okButton.addActionListener(listener);
		cancelButton.addActionListener(listener);
	}
	
	public JLabel getLblNumeroCassete() {
		return lblNumeroCassete;
	}
	
	public JComboBox getcBoxNumBloques() {
		return cBoxNumBloques;
	}
	
	public JComboBox getcBoxNumLaminas() {
		return cBoxNumLaminas;
	}
	
	public JTextArea getTextADescCassete() {
		return textADescCassete;
	}
	
	public int getRowOrigin() {
		return rowOrigin;
	}
	
	public JTableHistologia getRelatedTable() {
		return relatedTable;
	}
}
