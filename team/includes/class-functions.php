<?php



if ( ! defined('ABSPATH')) exit;  // if direct access 	


class class_team_functions  {
	
	
    public function __construct(){
		
		
		//$this->settings_page = new Team_Settings();
		
		
		//add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );
       //add_action('admin_menu', array($this, 'create_menu'));
    }
	

		
		
	public function team_member_posttype($posttype = array('team_member'))
		{
			return apply_filters('team_member_posttype', $posttype);
		}
		
	public function team_member_taxonomy($taxonomy = 'team_group')
		{
			return apply_filters('team_member_taxonomy', $taxonomy); //string only
		}		
		
		
		
		
	public function team_member_social_field(){
			
	
			$social_field = array(
									"mobile"=>array('meta_key'=>"mobile",'name'=>"Mobile",'icon'=>'','visibility'=>'1','can_remove'=>'no',),					
									"website"=>array('meta_key'=>"website",'name'=>"Website",'icon'=>'','visibility'=>'1','can_remove'=>'no',),
									"email"=>array('meta_key'=>"email",'name'=>"Email",'icon'=>'','visibility'=>'1','can_remove'=>'no',),						
									"skype"=>array('meta_key'=>"skype",'name'=>"Skype",'icon'=>'','visibility'=>'1','can_remove'=>'no',),					
									"facebook"=>array('meta_key'=>"facebook",'name'=>"Facebook",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),
									"twitter"=>array('meta_key'=>"twitter",'name'=>"Twitter",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),
									"googleplus"=>array('meta_key'=>"googleplus",'name'=>"Google plus",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),
									"pinterest"=>array('meta_key'=>"pinterest",'name'=>"Pinterest",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),
									"linkedin"=>array('meta_key'=>"linkedin",'name'=>"Linkedin",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),
									"vimeo"=>array('meta_key'=>"vimeo",'name'=>"Vimeo",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),
									"instagram"=>array('meta_key'=>"instagram",'name'=>"Instagram",'icon'=>'','visibility'=>'1','can_remove'=>'yes',),																						
					);					
					
			return apply_filters( 'team_member_social_field', $social_field );

			}		
		
		
		
		
		
	public function team_grid_items()
		{

			$team_grid_items = array(
					'thumbnail'=>__('Thumbnail','team'),
					'title'=>__('Title','team'),
					'position'=>__('Position','team'),
					'content'=>__('Content','team'),
					'social'=>__('Social','team'),
					);

			$team_grid_items = apply_filters('team_grid_items',$team_grid_items);


			return $team_grid_items;

			}


	
	
	public function skins(){
		
		$skins = array(
		
						'flat'=> array(
										'slug'=>'flat',									
										'name'=>'Flat',
										'thumb_url'=>'',
										'disabled'=>'',
										),

						'zoomout'=>array(
							'slug'=>'zoomout',
							'name'=>'ZoomOut',
							'thumb_url'=>'',
							'disabled'=>'',
						),

						'thumbrounded'=>array(
							'slug'=>'thumbrounded',
							'name'=>'ThumbRounded',
							'thumb_url'=>'',
							'disabled'=>'',
						),


										


						

            );
		
		$skins = apply_filters('team_filter_skins', $skins);	
		
		return $skins;
		
		}
	







	
	public function faq(){



		$faq['core'] = array(
							'title'=>__('Core', 'team'),
							'items'=>array(

											array(
												'question'=>__('How to upgrade to premium ?', 'team'),
												'answer_url'=>'https://pickplugins.com/documentation/team/faq/how-to-upgrade-to-pro/',
												),	

											array(
												'question'=>__('How to activate license ?', 'team'),
												'answer_url'=>'https://pickplugins.com/documentation/team/how-to-activate-license/',
												),	

											array(
												'question'=>__('How to create team ?', 'team'),
												'answer_url'=>'https://pickplugins.com/documentation/team/how-to-create-team/',
												),	

											array(
												'question'=>__('How to add custom profile fields ?', 'team'),
												'answer_url'=>'https://pickplugins.com/documentation/team/faq/how-to-add-custom-profile-fields/',
												),	

											array(
												'question'=>__('Team member page 404 not found.', 'team'),
												'answer_url'=>'https://pickplugins.com/documentation/team/faq/team-member-page-404-not-found/',
												),

											),

								
							);

					
		
		
		$faq = apply_filters('team_filters_faq', $faq);		

		return $faq;

		}		
	


	
	
	public function team_get_taxonomy_category($postid)
		{
	
		$team_taxonomy = array('team_group');
		
		if(empty($team_taxonomy))
			{
				$team_taxonomy= "";
			}
		$team_taxonomy_terms = get_post_meta( $postid, 'team_taxonomy_terms', true );
		
			
			if(empty($team_taxonomy_terms))
				{
					$team_taxonomy_terms =array('none'); // an empty array when no category element selected
	
				}
	
			if(!isset($_POST['taxonomy']))
				{
				$taxonomy =$team_taxonomy;
				}
			else
				{
				$taxonomy = isset($_POST['taxonomy']) ? sanitize_text_field(wp_unslash($_POST['taxonomy'])) : '';
				}
			
			
			$args=array(
			  'orderby' => 'name',
			  'order' => 'ASC',
			  'taxonomy' => $taxonomy,
			  );
		
		$categories = get_categories($args);
		
		
		if(empty($categories))
			{
			echo esc_html__("No Items Found!",'team');
			}
		
		
			$return_string = '';
			$return_string .= '<ul style="margin: 0;">';
		
		foreach($categories as $category){
			
			if(array_search($category->cat_ID, $team_taxonomy_terms))
			{
		   $return_string .= '<li class='.$category->cat_ID.'><label ><input class="team_taxonomy_terms" checked type="checkbox" name="team_taxonomy_terms['.$category->cat_ID.']" value ="'.$category->cat_ID.'" />'.$category->cat_name.'</label ></li>';
			}
			
			else
				{
					   $return_string .= '<li class='.$category->cat_ID.'><label ><input class="team_taxonomy_terms" type="checkbox" name="team_taxonomy_terms['.$category->cat_ID.']" value ="'.$category->cat_ID.'" />'.$category->cat_name.'</label ></li>';			
				}
			
			}
		
			$return_string .= '</ul>';
			
			return $return_string;
		
		if(isset($_POST['taxonomy']))
			{
				die();
			}
		
			
		}
		
	public function team_share_plugin()
		{
			
			?>



            <?php
			
			
			
		
		
		}






}


new class_team_functions();

