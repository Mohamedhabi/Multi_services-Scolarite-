from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
import time 
user_name = "mohamed@test.com"
password = "123"
driver = webdriver.Chrome()
driver.maximize_window()

driver.implicitly_wait(10) #wait 10 seconds when doing a find_element before carrying on
driver.get("http://192.168.1.6:5000/")
element = driver.find_element_by_id("email")
element.send_keys(user_name)
element = driver.find_element_by_id("password")
element.send_keys(password)
element.send_keys(Keys.RETURN)
continue_link = driver.find_element_by_link_text('Add')
continue_link.click()
element = driver.find_element_by_id("first_name")
element.send_keys("Prenom")
element = driver.find_element_by_id("last_name")
element.send_keys("Nom")
element = driver.find_element_by_id("birth_day")
element.send_keys("10/05/2000")
element = driver.find_element_by_id("birth_place")
element.send_keys("Setif")
element =Select(driver.find_element_by_id("level"))
element.select_by_value('1CS')
element = driver.find_element_by_id("adress")
element.send_keys("Setif")
element.send_keys(Keys.RETURN)
while():
    try:
        circle = driver.find_element_by_id("circle")
    except expression as expression:
        break


time.sleep(1)
driver.execute_script("window.scrollTo(0, document.body.scrollHeight)")

theList = driver.find_element_by_class_name("list-group")
items = theList.find_elements_by_class_name("list-group-item")
if items:
    button=items[-1].find_element_by_tag_name("div").find_element_by_tag_name("div").find_element_by_tag_name("button")
    button.click()
    time.sleep(3)
    alert = driver.switch_to.alert
    alert.accept() 

