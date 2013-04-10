package com.carrito.forms;

import javax.servlet.http.HttpServletRequest;

import org.apache.struts.action.ActionErrors;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionMapping;
import org.apache.struts.action.ActionMessage;

import com.carrito.util.AppUtil;

/**
 * 
 * Class: UsuarioForm <br />
 * DateCreated: 01/04/2013 <br />
 * @author T&T <br />
 *
 */
public class UsuarioForm extends ActionForm{
	/**
	 * 
	 */
	private static final long serialVersionUID = -6792584181520329054L;

	private int id;
	private String tipoDocumento;
	private String cedula;
	private String nombre;
	private String apellido;
	private String telefono;
	private String direccion;
	private String email;
	private String login;
	private String clave;
	private int idPerfil;
	
	public UsuarioForm() {
		// TODO Auto-generated constructor stub
	}

	@Override
	public ActionErrors validate(ActionMapping mapping,
			HttpServletRequest request) {
		// TODO Auto-generated method stub
		ActionErrors errors = new ActionErrors();
		
		//validamos los campos
		if(AppUtil.isEmptyOrNull(nombre)){
			errors.add("error.camponovacio", 
					new ActionMessage("error.camponovacio", new Object[]{"nombre"}));
		}
		if(AppUtil.isEmptyOrNull(apellido)){
			errors.add("error.camponovacio", 
					new ActionMessage("error.camponovacio", new Object[]{"apellido"}));
		}
		if(AppUtil.isEmptyOrNull(cedula)){
			errors.add("error.camponovacio", 
					new ActionMessage("error.camponovacio", new Object[]{"cedula"}));
		}
		if(AppUtil.isEmptyOrNull(telefono)){
			errors.add("error.camponovacio", 
					new ActionMessage("error.camponovacio", new Object[]{"telefono"}));
		}
		if(AppUtil.isEmptyOrNull(direccion)){
			errors.add("error.camponovacio", 
					new ActionMessage("error.camponovacio", new Object[]{"direccion"}));
		}
		if(AppUtil.isEmptyOrNull(login)){
			errors.add("error.camponovacio", 
					new ActionMessage("error.camponovacio", new Object[]{"login"}));
		}
		if(AppUtil.isEmptyOrNull(clave)){
			errors.add("error.camponovacio", 
					new ActionMessage("error.camponovacio", new Object[]{"clave"}));
		}
		if(AppUtil.isEmptyOrNull(email)){
			errors.add("error.camponovacio", 
					new ActionMessage("error.camponovacio", new Object[]{"email"}));
		}else{
			//email tiene un valor, verifico que sea un correo valido
			if(! AppUtil.isAValidEmail(email)){
				errors.add("error.formatonovalido", 
						new ActionMessage("error.formatonovalido", new Object[]{"correo"}));
			}
		}
		
		return errors;
	}
	
	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getTipoDocumento() {
		return tipoDocumento;
	}
	
	public void setTipoDocumento(String tipoDocumento) {
		this.tipoDocumento = tipoDocumento;
	}
	
	public String getCedula() {
		return cedula;
	}

	public void setCedula(String cedula) {
		this.cedula = cedula;
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getApellido() {
		return apellido;
	}

	public void setApellido(String apellido) {
		this.apellido = apellido;
	}

	public String getTelefono() {
		return telefono;
	}

	public void setTelefono(String telefono) {
		this.telefono = telefono;
	}

	public String getDireccion() {
		return direccion;
	}

	public void setDireccion(String direccion) {
		this.direccion = direccion;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getLogin() {
		return login;
	}

	public void setLogin(String login) {
		this.login = login;
	}

	public String getClave() {
		return clave;
	}

	public void setClave(String clave) {
		this.clave = clave;
	}

	public int getIdPerfil() {
		return idPerfil;
	}

	public void setIdPerfil(int idPerfil) {
		this.idPerfil = idPerfil;
	}
}
