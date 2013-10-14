package com.fjr.code.gui.operations;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;

import javax.swing.JTextArea;

import com.fjr.code.gui.SimpleTextEditorDialog;

/**
 * 
 * Class: ListenerDobleClickTextArea <br />
 * DateCreated: 14/10/2013 <br />
 * @author T&T <br />
 *
 */
public class ListenerDobleClickTextArea implements MouseListener {
	
	private JTextArea referencia;
	
	public ListenerDobleClickTextArea(JTextArea referencia) {
		// TODO Auto-generated constructor stub
		this.referencia = referencia;
	}
	
	@Override
	public void mouseClicked(MouseEvent arg0) {
		// TODO Auto-generated method stub
		if(arg0.getClickCount() == 2){
			new SimpleTextEditorDialog(referencia).setVisible(true);
			arg0.consume();
		}
	}

	@Override
	public void mouseEntered(MouseEvent arg0) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mouseExited(MouseEvent arg0) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mousePressed(MouseEvent arg0) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mouseReleased(MouseEvent arg0) {
		// TODO Auto-generated method stub
		
	}
}
