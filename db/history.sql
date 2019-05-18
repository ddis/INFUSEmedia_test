-- auto-generated definition
create table history
(
    ip_address  int unsigned                        not null,
    user_agent  varchar(255)                        not null,
    view_date   timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
    page_url    varchar(50)                         not null,
    views_count int unsigned                        not null,
    primary key (ip_address, user_agent, page_url)
);

