<?php 
/**
 * articles.sape.ru - ������� ���������� ������
 *
 * 
 * ��������! 
 * ��� ��  ��� ������ �������, � ���� ��� ����������� ������� ������.
 * 
 * � ����� � ����:
 * 
 * 1) �� ������� ��������� ��� �� ����� ����� � ������ ����� ������ �����! 
 *    ������ ������� ���� ����������� ��� �� ���������� http://articles.sape.ru/wm/sites/add/
 *  
 * 2) �� ������� �������� ������ ���� � ������ � ������� ������� ���� include/require!
 * 
 * ��������������, ��� ������ ���� ���������� ������ ���-��������, � ������ ������� URL ������.
 * 
 * ����� ������� ���� �� ��������� ����� ����� �������� � �� ������������� �����������.
 * 
 * �������: https://help.sape.ru/articles/faq
 *
 * �� ���� �������� ����������� �� support@sape.ru
 *
 */ 
     define('_SAPE_USER', 'bdba2e8b22730640fe465087a2738043');
     require_once($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php'); 
     $sape_articles = new SAPE_articles();
     //������ ����� ����� ���������� HTTP ��������� c ����� 404! �� ������� ��������� ��� �� �������� � ��������.     
     echo $sape_articles->process_request();
?>
