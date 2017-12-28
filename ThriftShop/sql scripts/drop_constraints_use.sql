alter table Buyer
drop foreign key`fk_Buyer_User1`;
 alter table Charity_Organizator
drop foreign key `fk_Charity_Organizator_User1`;
 alter table Charity_event
drop foreign key `fk_Charity_event_Charity_Organizator1`;
 alter table Donator
drop foreign key  `fk_table3_User1`;
 alter table Reviewer
drop foreign key `fk_Reviewer_User1`;
alter table Donated_item
drop foreign key`fk_Donated_item_Buyer1`;
alter table Donated_item
drop foreign key`fk_Donated_item_Donator1`;
alter table Donated_item
drop foreign key`fk_Donated_item_Reviewer1`;
 alter table   Charity_event_has_Buyer
drop foreign key `fk_Charity_event_has_Buyer_Charity_event1`;
 alter table   Charity_event_has_Buyer
drop foreign key `fk_Charity_event_has_Buyer_Buyer1`;