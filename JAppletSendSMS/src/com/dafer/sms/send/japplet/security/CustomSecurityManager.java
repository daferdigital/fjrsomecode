package com.dafer.sms.send.japplet.security;

import java.io.FileDescriptor;
import java.net.InetAddress;
import java.security.Permission;

/**
 * Debido al ajuste de el visor como una app que lee recursos locales (no 100% JNLP)
 * Se deben simular los permisos para la misma, basandonos en un SecurityManager que permita las operaciones necesarias
 * para esos recursos externos que no levanta el propio motor de JavaWebStart.
 * 
 * @author frojas
 *
 */
public class CustomSecurityManager extends SecurityManager {
	
	@Override
	public void checkAccept(String host, int port) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkAccess(Thread t) {
		// TODO Auto-generated method stub
		super.checkAccess(t);
	}
	
	@Override
	public void checkAccess(ThreadGroup g) {
		// TODO Auto-generated method stub
		super.checkAccess(g);
	}
	
	@Override
	public void checkAwtEventQueueAccess() {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkConnect(String host, int port) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkConnect(String host, int port, Object context) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkCreateClassLoader() {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkDelete(String file) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkExec(String cmd) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkExit(int status) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkLink(String lib) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkListen(int port) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkMemberAccess(Class<?> clazz, int which) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkMulticast(InetAddress maddr) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkMulticast(InetAddress maddr, byte ttl) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkPackageAccess(String pkg) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkPackageDefinition(String pkg) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkPermission(Permission perm) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkPermission(Permission perm, Object context) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkPrintJobAccess() {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkPropertiesAccess() {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkPropertyAccess(String key) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkRead(String file, Object context) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkRead(FileDescriptor fd) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkRead(String file) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkSecurityAccess(String target) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkSetFactory() {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkSystemClipboardAccess() {
		// TODO Auto-generated method stub
	}
	
	@Override
	public boolean checkTopLevelWindow(Object window) {
		// TODO Auto-generated method stub
		return true;
	}
	
	@Override
	public void checkWrite(FileDescriptor fd) {
		// TODO Auto-generated method stub
	}
	
	@Override
	public void checkWrite(String file) {
		// TODO Auto-generated method stub
	}
}
