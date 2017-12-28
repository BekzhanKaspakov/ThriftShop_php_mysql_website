alter table Buyer
ADD 
  CONSTRAINT `fk_Buyer_User1`
    FOREIGN KEY (`B_ID`)
    REFERENCES `mydb`.`User` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;
    
 alter table Charity_Organizator
ADD
  CONSTRAINT `fk_Charity_Organizator_User1`
    FOREIGN KEY (`C_ID`)
    REFERENCES `mydb`.`User` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;
    
alter table Charity_event
add
  CONSTRAINT `fk_Charity_event_Charity_Organizator1`
    FOREIGN KEY (`Charity_Organizator_C_ID`)
    REFERENCES `mydb`.`Charity_Organizator` (`C_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;
    
alter table Donator
ADD 
  CONSTRAINT `fk_table3_User1`
    FOREIGN KEY (`D_ID`)
    REFERENCES `mydb`.`User` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;
    
alter table Reviewer
Add
  CONSTRAINT `fk_Reviewer_User1`
    FOREIGN KEY (`R_ID`)
    REFERENCES `mydb`.`User` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;
    
alter table Donated_item
add 
  CONSTRAINT `fk_Donated_item_Buyer1`
    FOREIGN KEY (`Buyer_B_ID`)
    REFERENCES `mydb`.`Buyer` (`B_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION; 
alter table Donated_item
add 
  CONSTRAINT `fk_Donated_item_Donator1`
    FOREIGN KEY (`Donator_D_ID`)
    REFERENCES `mydb`.`Donator` (`D_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;
alter table Donated_item
add 
  CONSTRAINT `fk_Donated_item_Reviewer1`
    FOREIGN KEY (`Reviewer_R_ID`)
    REFERENCES `mydb`.`Reviewer` (`R_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;
    
 alter table   Charity_event_has_Buyer
 add
  CONSTRAINT `fk_Charity_event_has_Buyer_Charity_event1`
    FOREIGN KEY (`Charity_event_Ch_ID`)
    REFERENCES `mydb`.`Charity_event` (`Ch_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;
	
alter table   Charity_event_has_Buyer
 add
  CONSTRAINT `fk_Charity_event_has_Buyer_Buyer1`
    FOREIGN KEY (`Buyer_B_ID`)
    REFERENCES `mydb`.`Buyer` (`B_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;