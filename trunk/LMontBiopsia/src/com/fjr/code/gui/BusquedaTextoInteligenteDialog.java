package com.fjr.code.gui;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTable;
import javax.swing.border.EmptyBorder;
import java.awt.Toolkit;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import javax.swing.JScrollPane;
import javax.swing.JLabel;
import javax.swing.JTextField;

import com.fjr.code.dao.TextoInteligenteDAO;
import com.fjr.code.dao.definitions.CriterioBusquedaTextoInteligente;
import com.fjr.code.dto.TextoInteligenteDTO;
import com.fjr.code.gui.tables.maestros.JTableTextoInteligente;

import javax.swing.JComboBox;

/**
 * 
 * Class: BusquedaTextoInteligenteDialog
 * Creation Date: 13/10/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BusquedaTextoInteligenteDialog extends JDialog implements ActionListener{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = -1624841233959939114L;
	private static final String ACTION_COMMAND_BUSCAR = "buscar";
	private static final String ACTION_COMMAND_CANCEL = "cancel";
	
	private final JPanel contentPanel = new JPanel();
	private JScrollPane scrollPane;
	private JTable results;
	private JTextField txtValor1;
	private JTextField txtValor2;
	private SimpleTextEditorDialog ventanaReferencia;
	private JComboBox comboCriterio1;
	private JComboBox comboCriterio2;
	
	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			BusquedaTextoInteligenteDialog dialog = new BusquedaTextoInteligenteDialog(null);
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public BusquedaTextoInteligenteDialog(SimpleTextEditorDialog ventanaReferencia) {
		setModal(true);
		this.ventanaReferencia = ventanaReferencia;
		CriterioBusquedaTextoInteligente[] criterios = CriterioBusquedaTextoInteligente.values();
		
		setTitle("Busqueda de Textos Pre-Configurados");
		setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
		setIconImage(Toolkit.getDefaultToolkit().getImage(BusquedaTextoInteligenteDialog.class.getResource("/resources/images/iconLogo1.jpg")));
		setBounds(100, 100, 700, 485);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		
		scrollPane = new JScrollPane();
		scrollPane.setBounds(10, 68, 672, 416);
		contentPanel.add(scrollPane);
		
		results = JTableTextoInteligente.getNewInstance(null, false, ventanaReferencia).getJTable();
		scrollPane.setViewportView(results);
		
		JLabel lblCdigo = new JLabel("Criterio 1:");
		lblCdigo.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblCdigo.setBounds(10, 11, 71, 16);
		contentPanel.add(lblCdigo);
		
		JLabel lblAbreviatura = new JLabel("Criterio 2:");
		lblAbreviatura.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblAbreviatura.setBounds(10, 38, 71, 16);
		contentPanel.add(lblAbreviatura);
		
		txtValor1 = new JTextField();
		txtValor1.setBounds(400, 10, 150, 20);
		contentPanel.add(txtValor1);
		txtValor1.setColumns(10);
		
		txtValor2 = new JTextField();
		txtValor2.setColumns(10);
		txtValor2.setBounds(400, 37, 150, 20);
		contentPanel.add(txtValor2);
		
		comboCriterio1 = new JComboBox();
		comboCriterio1.setBounds(91, 10, 175, 20);
		for (int i = 0; i < criterios.length; i++) {
			if(criterios[i].isShowInCombo()){
				comboCriterio1.addItem(criterios[i]);
			}
		}
		contentPanel.add(comboCriterio1);
		
		comboCriterio2 = new JComboBox();
		comboCriterio2.setBounds(91, 37, 175, 20);
		for (int i = 0; i < criterios.length; i++) {
			if(criterios[i].isShowInCombo()){
				comboCriterio2.addItem(criterios[i]);
			}
		}
		contentPanel.add(comboCriterio2);
		
		JLabel lblValorCriterio = new JLabel("Valor Criterio 1:");
		lblValorCriterio.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblValorCriterio.setBounds(286, 12, 111, 14);
		contentPanel.add(lblValorCriterio);
		
		JLabel lblValorCriterio_1 = new JLabel("Valor Criterio 2:");
		lblValorCriterio_1.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblValorCriterio_1.setBounds(286, 39, 111, 14);
		contentPanel.add(lblValorCriterio_1);
		
		JButton btnBuscar_1 = new JButton("Buscar");
		btnBuscar_1.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnBuscar_1.setBounds(561, 9, 89, 23);
		btnBuscar_1.addActionListener(this);
		btnBuscar_1.setActionCommand(ACTION_COMMAND_BUSCAR);
		contentPanel.add(btnBuscar_1);
		
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton cancelButton = new JButton("Cancel");
				cancelButton.setFont(new Font("Tahoma", Font.PLAIN, 12));
				cancelButton.setActionCommand(ACTION_COMMAND_CANCEL);
				cancelButton.addActionListener(this);
				buttonPane.add(cancelButton);
			}
		}
		
		setLocationRelativeTo(null);
	}

	public SimpleTextEditorDialog getVentanaReferencia() {
		return ventanaReferencia;
	}
	
	public void setVentanaReferencia(SimpleTextEditorDialog ventanaReferencia) {
		this.ventanaReferencia = ventanaReferencia;
	}
	
	public JTextField getTextCodigo() {
		return txtValor1;
	}

	public void setTextCodigo(JTextField textCodigo) {
		this.txtValor1 = textCodigo;
	}

	public JTextField getTextAbreviatura() {
		return txtValor2;
	}

	public void setTextAbreviatura(JTextField textAbreviatura) {
		this.txtValor2 = textAbreviatura;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BUSCAR.equals(e.getActionCommand())){
			//se deben buscar las biopsias bajo el criterio indicado
			//y el valor dado
			Map<CriterioBusquedaTextoInteligente, String> valores = new HashMap<CriterioBusquedaTextoInteligente, String>();
			valores.put((CriterioBusquedaTextoInteligente) comboCriterio1.getSelectedItem(), txtValor1.getText());
			valores.put((CriterioBusquedaTextoInteligente) comboCriterio2.getSelectedItem(), txtValor2.getText());
			
			List<TextoInteligenteDTO> results = TextoInteligenteDAO.searchAllByCriteria(valores);
			
			if(results == null || results.size() == 0){
				//el listado no trajo resultados
				JOptionPane.showMessageDialog(this, "Para los criterios de búsqueda indicados no se obtuvieron resultados", 
						"No se encontraron resultados", 
						JOptionPane.ERROR_MESSAGE);
			} else {
				this.results = JTableTextoInteligente.getNewInstance(results, false, ventanaReferencia).getJTable();
				refreshResultViewPort();
			}
		} else if(ACTION_COMMAND_CANCEL.equals(e.getActionCommand())){
			this.setVisible(false);
			this.dispose();
		}
	}
	
	private void refreshResultViewPort(){
		scrollPane.setVisible(false);
		scrollPane.setViewportView(null);
		scrollPane.repaint();
		scrollPane.setViewportView(results);
		scrollPane.setVisible(true);
		scrollPane.repaint();
	}
}
