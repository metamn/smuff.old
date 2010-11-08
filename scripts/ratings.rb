require 'mysql2'
require 'active_record'

ActiveRecord::Base.establish_connection(
    :adapter  => "mysql2",
    :host     => "localhost",
    :username => "cs",
    :password => "",
    :database => "ujsmuff"
)

class Post < ActiveRecord::Base  
  set_table_name "wp_cp53mf_posts"
  set_primary_key "ID"
  
  has_many  :post_metas  
end

class PostMeta < ActiveRecord::Base  
  set_table_name "wp_cp53mf_postmeta"
  set_primary_key "meta_id"
  
  belongs_to :post
end

# Getting all posts
posts = Post.where(:post_status => 'publish', :post_type => 'post')

# Getting all posts w. postmetas
#posts = Post.where(:post_status => 'publish', :post_type => 'post').joins(:post_metas)



posts.each do |p|
  puts p.post_title
  v = p.post_metas.where(:meta_key => 'views').first.meta_value
  
  a = 4 + rand(99).to_f/100
  u = v.to_i/20 + 1 + rand(2)
  s = u*a  
  #puts " - views: #{v}"
  #puts " - ratings average: #{printf('%.2f', a)}"
  #puts " - ratings score: #{s}"
  #puts " - ratings users: #{u.to_i}"
  
  ra = p.post_metas.where(:meta_key => 'ratings_average').first
  unless ra.nil?
    puts " - ra = #{ra.meta_value}"
    PostMeta.update(ra.id, :meta_value => sprintf("%.2f", a))
  end   
  
  rs = p.post_metas.where(:meta_key => 'ratings_score').first
  unless rs.nil?
    puts " - rs = #{rs.meta_value}"
    PostMeta.update(rs.id, :meta_value => sprintf("%.2f", s))
  end 
  
  ru = p.post_metas.where(:meta_key => 'ratings_users').first
  unless ru.nil?
    puts " - ru = #{ru.meta_value}"
    PostMeta.update(ru.id, :meta_value => u.to_i)
  end 
   
end





