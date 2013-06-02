class ApiController < ApplicationController
  # before_filter :oath_required

  respond_to :json, :xml
	def push
    @ft = GData::Client::FusionTables.new
    @ft.clientlogin(ENV['G_USER'], ENV['G_PASS'])
    @ft.set_api_key(ENV['FUSION_API_KEY'])
    if (params[:time_created].empty? ||
        params[:lat].empty? ||
        params[:long].empty? ||
        params[:severity].empty?)
      @success = false
    else
      data = [{"time_created"  => DateTime.strptime(params[:time_created], "%Y-%m-%d %H:%M:%S"),
               "lat"           => params[:lat],
               "long"          => params[:long],
               "severity"      => params[:severity]}]
      # Find table somehow?
      tables = @ft.show_tables.select{ |table| table.id == '1CDBDXE5rBU5wuFKvtlVtd6H7Wh9kLc0ffT8PKQQ'}
      @success = tables.first.insert data
    end
	end

    #adding more api
end
