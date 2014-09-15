package com.fjr.code.gui.maestros;

import javax.swing.JPanel;
import javax.swing.JLabel;

import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import javax.swing.JComboBox;

import com.fjr.code.dao.PatologoDAO;
import com.fjr.code.dao.definitions.CriterioBusquedaUsuario;
import com.fjr.code.dto.PatologoDTO;
import com.fjr.code.gui.AppWindow;
import com.fjr.code.gui.tables.maestros.JTablePatologos;
import com.fjr.code.util.Constants;

import javax.swing.JOptionPane;
import javax.swing.JTextField;
import javax.swing.JButton;

/**
 * 
 * Class: BusquedaUsuarioPanel
 * Creation Date: 02/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BusquedaPatologosPanel extends JPanel implements ActionListener{
	/**
	 * 
	 */
	private static final long serialVersionUID = 3518439321990846678L;
	private static final String ACTION_COMMAND_BUSCAR = "buscar";
	private static final String ACTION_COMMAND_CREAR = "crear";
	private JComboBox comboBox1;
	private JTextField txtValor1;
	private JComboBox comboBox2;
	private JTextField txtValor2;
	private JButton btnBuscar;
	
	/**
	 * Create the panel.
	 */
	public BusquedaPatologosPanel() {
		setLayout(null);
		CriterioBusquedaUsuario[] criterios = CriterioBusquedaUsuario.values();
		
		JLabel lblCriterioDeBsqueda = new JLabel("<html><b>Criterio de B&uacute;squeda 1:</b></html>");
		lblCriterioDeBsqueda.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblCriterioDeBsqueda.setBounds(10, 11, 172, 16);
		add(lblCriterioDeBsqueda);
		
		comboBox1 = new JComboBox();
		comboBox1.setBounds(192, 10, 232, 20);
		for (int i = 0; i < criterios.length; i++) {
			if(criterios[i].isShowInCombo()){
				comboBox1.addItem(criterios[i]);
			}
		}
		add(comboBox1);
		
		setSize(1000, 95);
		setLocation(0, Constants.APP_MENU_HEIGTH);
		
		JLabel lblvalorABuscar = new JLabel("<html><b>Valor a Buscar:</b></html>");
		lblvalorABuscar.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblvalorABuscar.setBounds(452, 11, 108, 16);
		add(lblvalorABuscar);
		
		txtValor1 = new JTextField();
		txtValor1.setBounds(572, 10, 232, 20);
		add(txtValor1);
		txtValor1.setColumns(10);
		
		btnBuscar = new JButton("Buscar");
		btnBuscar.setActionCommand(ACTION_COMMAND_BUSCAR);
		btnBuscar.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnBuscar.setBounds(812, 9, 89, 23);
		btnBuscar.addActionListener(this);
		add(btnBuscar);
		
		JLabel lblcriterioDeBuacutesqueda = new JLabel("<html><b>Criterio de B&uacute;squeda 2:</b></html>");
		lblcriterioDeBuacutesqueda.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblcriterioDeBuacutesqueda.setBounds(10, 39, 172, 16);
		add(lblcriterioDeBuacutesqueda);
		
		comboBox2 = new JComboBox();
		comboBox2.setBounds(192, 38, 232, 20);
		for (int i = 0; i < criterios.length; i++) {
			if(criterios[i].isShowInCombo()){
				comboBox2.addItem(criterios[i]);
			}
		}
		add(comboBox2);
		
		JLabel label_1 = new JLabel("<html><b>Valor a Buscar:</b></html>");
		label_1.setFont(new Font("Tahoma", Font.PLAIN, 13));
		label_1.setBounds(452, 39, 108, 16);
		add(label_1);
		
		txtValor2 = new JTextField();
		txtValor2.setColumns(10);
		txtValor2.setBounds(572, 38, 232, 20);
		add(txtValor2);
		
		JButton btnCrearTipoDe = new JButton("Crear Patologo");
		btnCrearTipoDe.setFont(new Font("Tahoma", Font.PLAIN, 12));
		btnCrearTipoDe.setActionCommand(ACTION_COMMAND_CREAR);
		btnCrearTipoDe.setBounds(812, 37, 153, 23);
		btnCrearTipoDe.addActionListener(this);
		add(btnCrearTipoDe);
		
		setVisible(true);
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		if(ACTION_COMMAND_BUSCAR.equals(e.getActionCommand())){
			//se deben buscar los usuarios bajo los criterios indicados
			//y el valor dado
			Map<CriterioBusquedaUsuario, String> valores = new HashMap<CriterioBusquedaUsuario, String>();
			valores.put((CriterioBusquedaUsuario) comboBox1.getSelectedItem(), txtValor1.getText());
			valores.put((CriterioBusquedaUsuario) comboBox2.getSelectedItem(), txtValor2.getText());
			
			List<PatologoDTO> results = PatologoDAO.searchAllByCriteria(valores);
			
			if(results == null || results.size() == 0){
				//el listado no trajo resultados
				JOptionPane.showMessageDialog(this, "Para los criterios de búsqueda indicados no se obtuvieron resultados", 
						"No se encontraron resultados", 
						JOptionPane.ERROR_MESSAGE);
			} else {
				AppWindow.getInstance().setPanelContenido(null, 
						JTablePatologos.getNewInstance(results, this).getJTable());
			}
		} else if(ACTION_COMMAND_CREAR.equals(e.getActionCommand())){
			new PatologoDialog(-1, this).setVisible(true);
		}
	}
	
	/**
	 * Simulamos el evento de click en el boton de buscar de este panel.
	 * 
	 */
	public void reloadResults(){
		try {
			btnBuscar.doClick();
		} catch (Exception e) {
			// TODO: handle exception
		}
	}
}
