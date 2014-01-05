package com.fjr.code.gui;

import java.awt.EventQueue;
import java.awt.Image;

import javax.swing.JDialog;

import com.fjr.code.dao.BiopsiaMicroLaminasDAO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaMacroFotoDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasFileDTO;
import com.fjr.code.gui.tables.JTableDiagnosticoWizard;
import com.fjr.code.pdf.BiopsiaDiagnostico;
import com.fjr.code.util.Constants;
import java.awt.Toolkit;
import javax.swing.border.LineBorder;
import java.awt.Color;

import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JScrollPane;
import javax.swing.JButton;
import javax.swing.SwingConstants;

import javax.swing.JPanel;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.JTable;
import java.awt.Font;

public class DiagnosticoWizardDialog extends JDialog implements ActionListener{
	public static final String ACTION_COMMAND_LIMPIAR = "limpiar";
	public static final String ACTION_COMMAND_VER = "ver";
	
	/**
	 * 
	 */
	private static final long serialVersionUID = -7390526096303876520L;
	private JTableDiagnosticoWizard wizard = JTableDiagnosticoWizard.getNewInstance();
	private JTable tableWizard;
	private BiopsiaInfoDTO biopsia;
	private String firmante1;
	private String firmante2;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					DiagnosticoWizardDialog dialog = new DiagnosticoWizardDialog(null, "", "");
					dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
					dialog.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the dialog.
	 * 
	 * @param biopsia
	 * @param firmante1
	 * @param firmante2
	 */
	public DiagnosticoWizardDialog(BiopsiaInfoDTO biopsia, String firmante1,
			String firmante2) {
		this.biopsia = biopsia;
		this.firmante1 = firmante1;
		this.firmante2 = firmante2;
		
		setModal(true);
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setTitle("Wizard de Diagnostico");
		setIconImage(Toolkit.getDefaultToolkit().getImage(DiagnosticoWizardDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, Constants.APP_WINDOW_MAX_X, Constants.APP_WINDOW_MAX_Y);
		
		setLocationRelativeTo(null);
		getContentPane().setLayout(null);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBorder(new LineBorder(Color.BLACK));
		scrollPane.setBounds(0, 0, 465, 662);
		getContentPane().add(scrollPane);
		
		JPanel panel = new JPanel();
		scrollPane.setViewportView(panel);
		panel.setLayout(new GridLayout(0, 1, 0, 0));
		
		setBiopsiaInfoPanel(biopsia, panel);
		
		JScrollPane scrollPane_1 = new JScrollPane();
		scrollPane_1.setBorder(new LineBorder(Color.BLACK));
		scrollPane_1.setBounds(475, 37, 499, 614);
		getContentPane().add(scrollPane_1);
		
		tableWizard = wizard.getTable();
		scrollPane_1.setViewportView(tableWizard);
		
		JButton btnVerDiagnostico = new JButton("Ver Diagnostico");
		btnVerDiagnostico.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnVerDiagnostico.setBounds(475, 11, 123, 23);
		btnVerDiagnostico.setActionCommand(ACTION_COMMAND_VER);
		btnVerDiagnostico.addActionListener(this);
		getContentPane().add(btnVerDiagnostico);
		
		JLabel lblparaEliminarUn = new JLabel("<html>Para eliminar una fila haga doble click sobre la misma</html>");
		lblparaEliminarUn.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblparaEliminarUn.setBounds(706, 0, 268, 34);
		getContentPane().add(lblparaEliminarUn);
		
		JButton btnLimpiar = new JButton("Limpiar");
		btnLimpiar.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnLimpiar.setBounds(605, 11, 91, 23);
		btnLimpiar.setActionCommand(ACTION_COMMAND_LIMPIAR);
		btnLimpiar.addActionListener(this);
		getContentPane().add(btnLimpiar);
	}
	
	/**
	 * 
	 * @param biopsia
	 */
	private void setBiopsiaInfoPanel(BiopsiaInfoDTO biopsia,
			JPanel panelBiopsia){
		
		if(biopsia.getMacroscopicaDTO().getMacroFotosDTO() != null){
			JLabel label = new JLabel("PER-OPERATORIA");
			label.setHorizontalAlignment(SwingConstants.LEFT);
			panelBiopsia.add(label);
			
			JButton btnDesc = new JButton("");
			btnDesc.setBorderPainted(false);
			btnDesc.setToolTipText(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA);
			btnDesc.setName(btnDesc.getText());
			btnDesc.setHorizontalAlignment(SwingConstants.LEFT);
			btnDesc.addActionListener(this);
			panelBiopsia.add(btnDesc);
			
			for (BiopsiaMacroFotoDTO macroFoto : biopsia.getMacroscopicaDTO().getMacroFotosDTO()) {
				if(macroFoto.isFotoPerOperatoria()){
					/*
					btnDesc = new JButton(macroFoto.getNotacion()
							+ ": " + macroFoto.getDescripcion());
					*/
					btnDesc = new JButton(macroFoto.getDescripcion());
					
					btnDesc.setBorderPainted(false);
					btnDesc.setToolTipText(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA);
					btnDesc.setName(btnDesc.getText());
					btnDesc.setHorizontalAlignment(SwingConstants.LEFT);
					btnDesc.addActionListener(this);
					panelBiopsia.add(btnDesc);
					
					Icon icon = new ImageIcon(new ImageIcon(macroFoto.getFotoFile().getAbsolutePath()).getImage().getScaledInstance(
							150,
							120,
							Image.SCALE_AREA_AVERAGING));
					//debo colocarla como icono en la etiqueta respectiva
					
					JButton btnImg = new JButton(icon);
					btnImg.setBorderPainted(false);
					btnImg.setToolTipText(JTableDiagnosticoWizard.SECCION_PER_OPERATORIA);
					btnImg.setName(macroFoto.getFotoFile().getAbsolutePath());
					btnImg.setHorizontalAlignment(SwingConstants.LEFT);
					btnImg.addActionListener(this);
					panelBiopsia.add(btnImg);
				}
			}
		}
		
		if(biopsia.getMacroscopicaDTO().getMacroFotosDTO() != null){
			JLabel label = new JLabel("FOTOS MACRO");
			label.setHorizontalAlignment(SwingConstants.LEFT);
			panelBiopsia.add(label);
			
			JButton btnDesc = new JButton("");
			btnDesc.setBorderPainted(false);
			btnDesc.setToolTipText(JTableDiagnosticoWizard.SECCION_MACRO);
			btnDesc.setName(btnDesc.getText());
			btnDesc.setHorizontalAlignment(SwingConstants.LEFT);
			btnDesc.addActionListener(this);
			panelBiopsia.add(btnDesc);
			
			for (BiopsiaMacroFotoDTO macroFoto : biopsia.getMacroscopicaDTO().getMacroFotosDTO()) {
				if(! macroFoto.isFotoPerOperatoria()){
					btnDesc = new JButton(macroFoto.getNotacion()
							+ ": " + macroFoto.getDescripcion());
					btnDesc.setBorderPainted(false);
					btnDesc.setToolTipText(JTableDiagnosticoWizard.SECCION_MACRO);
					btnDesc.setName(btnDesc.getText());
					btnDesc.setHorizontalAlignment(SwingConstants.LEFT);
					btnDesc.addActionListener(this);
					panelBiopsia.add(btnDesc);
					
					Icon icon = new ImageIcon(new ImageIcon(macroFoto.getFotoFile().getAbsolutePath()).getImage().getScaledInstance(
							150,
							120,
							Image.SCALE_AREA_AVERAGING));
					//debo colocarla como icono en la etiqueta respectiva
					
					JButton btnImg = new JButton(icon);
					btnImg.setBorderPainted(false);
					btnImg.setToolTipText(JTableDiagnosticoWizard.SECCION_MACRO);
					btnImg.setName(macroFoto.getFotoFile().getAbsolutePath());
					btnImg.setHorizontalAlignment(SwingConstants.LEFT);
					btnImg.addActionListener(this);
					panelBiopsia.add(btnImg);
				}
			}
		}
		
		BiopsiaMicroLaminasDAO.setMicroLaminas(biopsia, true);
		if(biopsia.getMicroscopicaDTO().getLaminasDTO() != null){
			JLabel label = new JLabel("FOTOS IHQ");
			label.setHorizontalAlignment(SwingConstants.LEFT);
			panelBiopsia.add(label);
			
			JButton btnDesc = new JButton("");
			btnDesc.setBorderPainted(false);
			btnDesc.setToolTipText(JTableDiagnosticoWizard.SECCION_IHQ);
			btnDesc.setName(btnDesc.getText());
			btnDesc.setHorizontalAlignment(SwingConstants.LEFT);
			btnDesc.addActionListener(this);
			panelBiopsia.add(btnDesc);
			
			for (BiopsiaMicroLaminasDTO microLaminaIHQ : biopsia.getMicroscopicaDTO().getLaminasDTO()) {
				btnDesc = new JButton(microLaminaIHQ.getDescripcion());
				btnDesc.setBorderPainted(false);
				btnDesc.setToolTipText(JTableDiagnosticoWizard.SECCION_IHQ);
				btnDesc.setName(btnDesc.getText());
				btnDesc.setHorizontalAlignment(SwingConstants.LEFT);
				btnDesc.addActionListener(this);
				panelBiopsia.add(btnDesc);
				
				if(microLaminaIHQ.getMicroLaminasFilesDTO() != null){
					for (BiopsiaMicroLaminasFileDTO microLaminaFile : microLaminaIHQ.getMicroLaminasFilesDTO()) {
						Icon icon = new ImageIcon(new ImageIcon(microLaminaFile.getMediaFile().getAbsolutePath()).getImage().getScaledInstance(
								150,
								120,
								Image.SCALE_AREA_AVERAGING));
						//debo colocarla como icono en la etiqueta respectiva
						
						JButton btnImg = new JButton(icon);
						btnImg.setBorderPainted(false);
						btnImg.setHorizontalAlignment(SwingConstants.LEFT);
						btnImg.setToolTipText(JTableDiagnosticoWizard.SECCION_IHQ);
						btnImg.setName(microLaminaFile.getMediaFile().getAbsolutePath());
						btnImg.addActionListener(this);
						panelBiopsia.add(btnImg);
					}
				}
			}
			
		}
		
		BiopsiaMicroLaminasDAO.setMicroLaminas(biopsia, false);
		if(biopsia.getMicroscopicaDTO().getLaminasDTO() != null){
			JLabel label = new JLabel("FOTOS MICRO");
			label.setHorizontalAlignment(SwingConstants.LEFT);
			panelBiopsia.add(label);
			
			JButton btnDesc = new JButton("");
			btnDesc.setBorderPainted(false);
			btnDesc.setToolTipText(JTableDiagnosticoWizard.SECCION_DIAGNOSTICO);
			btnDesc.setName(btnDesc.getText());
			btnDesc.setHorizontalAlignment(SwingConstants.LEFT);
			btnDesc.addActionListener(this);
			panelBiopsia.add(btnDesc);
			
			for (BiopsiaMicroLaminasDTO microLaminaIHQ : biopsia.getMicroscopicaDTO().getLaminasDTO()) {
				btnDesc = new JButton(microLaminaIHQ.getDescripcion());
				btnDesc.setBorderPainted(false);
				btnDesc.setToolTipText(JTableDiagnosticoWizard.SECCION_DIAGNOSTICO);
				btnDesc.setName(btnDesc.getText());
				btnDesc.setHorizontalAlignment(SwingConstants.LEFT);
				btnDesc.addActionListener(this);
				panelBiopsia.add(btnDesc);
				
				if(microLaminaIHQ.getMicroLaminasFilesDTO() != null){
					for (BiopsiaMicroLaminasFileDTO microLaminaFile : microLaminaIHQ.getMicroLaminasFilesDTO()) {
						Icon icon = new ImageIcon(new ImageIcon(microLaminaFile.getMediaFile().getAbsolutePath()).getImage().getScaledInstance(
								150,
								120,
								Image.SCALE_AREA_AVERAGING));
						//debo colocarla como icono en la etiqueta respectiva
						
						JButton btnImg = new JButton(icon);
						btnImg.setToolTipText(JTableDiagnosticoWizard.SECCION_DIAGNOSTICO);
						btnImg.setName(microLaminaFile.getMediaFile().getAbsolutePath());
						btnImg.setBorderPainted(false);
						btnImg.setHorizontalAlignment(SwingConstants.LEFT);
						btnImg.addActionListener(this);
						panelBiopsia.add(btnImg);
					}
				}
			}	
		}
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_LIMPIAR.equals(e.getActionCommand())){
			wizard.deleteAllRows();
		} else if(ACTION_COMMAND_VER.equals(e.getActionCommand())){
			BiopsiaDiagnostico  diagnostico = new BiopsiaDiagnostico(
					biopsia,
					firmante1,
					firmante2,
					wizard.getMapMacro(),
					wizard.getMapIHQ(),
					wizard.getMapDiagnostico());
			diagnostico.buildDiagnostico();
			
			try {
				diagnostico.open();
			} catch (Throwable e1) {
				// TODO: handle exception
				JOptionPane.showMessageDialog(null, e1.getLocalizedMessage(), 
						"Error abriendo diagnostico", 
						JOptionPane.ERROR_MESSAGE);
				e1.printStackTrace();
			}
		} else {
			wizard.addRow((JButton) e.getSource());
		}
	}
}
