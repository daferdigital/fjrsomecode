package com.dafer.sms.send.japplet.util;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.util.LinkedList;
import java.util.List;

/**
 * 
 * Class: ContactsUtil <br />
 * DateCreated: 02/10/2014 <br />
 * @author T&T <br />
 *
 */
public final class ContactsUtil {
	private ContactsUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param contactList
	 * @return
	 */
	public static List<String> getPhoneNumbers(File contactList){
		List<String> contacts = new LinkedList<String>();
		
		FileReader fr = null;
		BufferedReader br = null;
		
		try {
			fr = new FileReader(contactList);
			br = new BufferedReader(fr);
			
			String line = null;
			while ((line = br.readLine()) != null) {
				if(!"".equals(line)){
					contacts.add(line);
				}
			}
		} catch (Exception e) {
			// TODO: handle exception
		}finally {
			try {
				br.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
			
			try {
				fr.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
		}
		
		return contacts;
	}
}
